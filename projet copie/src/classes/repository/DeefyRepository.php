<?php
declare(strict_types=1);

namespace iutnc\deefy\repository;

use iutnc\deefy\audio\lists\AudioList;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use function Sodium\add;

class DeefyRepository
{
    private \PDO $pdo;
    private static ?DeefyRepository $instance = null;
    private static array $config = [];

    private function __construct(array $conf)
    {
        $this->pdo = new \PDO($conf['dsn'], $conf['user'], $conf['pass'],
            [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DeefyRepository(self::$config);
        }
        return self::$instance;
    }

    public static function setConfig(string $file)
    {
        $conf = parse_ini_file($file);
        if ($conf === false) {
            throw new \Exception("Error reading configuration file");
        }
        self::$config = [
            'dsn' => $conf['dsn'],
            'user' => $conf['user'],
            'pass' => $conf['pass']
        ];
    }

    public function findAllPlaylists(int $idUser): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user2playlist WHERE id_user = :id");
        $stmt->execute([':id' => $idUser]);

        $playlists = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

            $playlists[$row['id_pl']] = $this->getPlaylist($row['id_pl']);
        }

        return $playlists;
    }

    public function addPlaylistVide(Playlist $pl, int $idUser)
    {
        $stmt = $this->pdo->prepare("INSERT INTO playlist (nom) VALUES (:nom)");
        $stmt->execute([':nom' => $pl->nom]);
        $stmt = $this->pdo->prepare("SELECT id FROM playlist WHERE nom = :nom");
        $stmt->execute([':nom' => $pl->nom]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $id = $result['id'];
        $stmt = $this->pdo->prepare("INSERT INTO user2playlist (id_user, id_pl) VALUES (:id_user, :id_pl)");
        $stmt->execute([':id_user' => $idUser, ':id_pl' => $id]);
    }

    public function addTrack(AudioTrack $a): int
    {
        if ($a instanceof \iutnc\deefy\audio\tracks\PodcastTrack) {

            $stmt = $this->pdo->prepare("INSERT INTO track (titre, auteur_podcast, date_posdcast, genre, filename, duree, type) VALUES (:titre, :artiste, :annee, :genre, :nomFichier, :duree, 'P')");
            $stmt->execute([
                ':titre' => $a->titre,
                ':artiste' => $a->auteur,
                ':annee' => $a->date,
                ':genre' => $a->genre,
                ':nomFichier' => $a->nomFichier,
                ':duree' => $a->duree
            ]);
        } else {

            $stmt = $this->pdo->prepare("INSERT INTO track ( titre, annee_album, genre, filename,titre_album, duree, artiste_album, titre_ablum) VALUES (:titre, :annee, :genre, :nomFichier,:album ,:duree, :artiste, 'A', :titreAlbum)");
            $stmt->execute([
                ':nomFichier' => $a->nomFichier,
                ':titre' => $a->titre,
                ':album' => $a->album,
                ':annee' => $a->annee,
                ':duree' => $a->duree,
                ':genre' => $a->genre,
                ':artiste' => $a->artiste,
                ':titreAlbum' => $a->Album
            ]);

        }
        $stmt = $this->pdo->prepare("SELECT id FROM track WHERE filename = :nomFichier and titre = :titre and genre = :genre and duree = :duree");
        $stmt->execute([
            ':nomFichier' => $a->nomFichier,
            ':titre' => $a->titre,
            ':duree' => $a->duree,
            ':genre' => $a->genre,

        ]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $id = $result['id'];

       return $id;
    }


    public function addTrackToPlaylist(int $id, Playlist $pl)
    {
        // Récupérer l'id de la track
        $stmt = $this->pdo->prepare("SELECT id FROM track WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        // Vérifier si l'enregistrement de la track a été trouvé
        $id = $result['id'];

        // Récupérer l'id de la playlist
        $stmt = $this->pdo->prepare("SELECT id FROM playlist WHERE nom = :nom");
        $stmt->execute([':nom' => $pl->nom]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        // Vérifier si l'enregistrement de la playlist a été trouvé
        $id2 = $result['id'];

        // Récupérer le maximum de no_piste_dans_liste pour cette playlist
        $stmt = $this->pdo->prepare("SELECT COALESCE(MAX(no_piste_dans_liste), 0) AS max_no_piste FROM playlist2track WHERE id_pl = :id_playlist");
        $stmt->execute([':id_playlist' => $id2]);
        $maxResult = $stmt->fetch(\PDO::FETCH_ASSOC);
        $noPiste = $maxResult['max_no_piste'] + 1; // Calculer le nouveau numéro de piste

        // Insérer la track dans la playlist
        $stmt = $this->pdo->prepare("INSERT INTO playlist2track (id_pl, id_track, no_piste_dans_liste) VALUES (:id_playlist, :id_track, :no_piste)");
        $stmt->execute([':id_playlist' => $id2, ':id_track' => $id, ':no_piste' => $noPiste]);
    }


    public function getPlaylist(int $id): AudioList
    {
        $stmt = $this->pdo->prepare("SELECT * FROM playlist2track 
        inner join track on track.id = playlist2track.id_track
        WHERE id_pl = :id");
        $stmt->execute([':id' => $id]);

        $tracks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            if ($row['type'] != "A") $tracks[] = new PodcastTrack($row['titre'], $row['filename'], $row['auteur_podcast'], $row['date_posdcast'], $row['duree'], $row['genre']);
            else $tracks[] = new AlbumTrack($row['titre'], $row['filename'], $row['titre_album'], $row['no_piste_dans_liste'], $row['duree'], $row['genre'], $row['annee_album'], $row['artiste_album']);
            echo"ok";
        }

        $stmt = $this->pdo->prepare("SELECT nom FROM playlist
        WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $playlist = new Playlist($stmt->fetch(\PDO::FETCH_ASSOC)['nom'], 0, 0, $tracks);
        return $playlist;
    }


    public function getPDO(): \PDO
    {
        return $this->pdo;
    }
}