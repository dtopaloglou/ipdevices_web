<?php
session_start();
if(!isset($_SESSION['uid']))
    exit;

require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/dbc.php');



$info = array("data" => array());

$pdo = Registry::getConnection();
$query = $pdo->prepare("SELECT c.*, p.IP,p.Date, d.Location, d.did, d.Name
                        FROM client c, device d, ip p
                        WHERE c.uid = :uid
                        AND c.uid IN(
                            SELECT d1.uid
                            FROM device d1
                            WHERE c.uid = d1.uid
                                AND d.did = d1.did
                                AND d1.did IN(
                                    SELECT p1.did
                                    FROM ip p1
                                    WHERE p1.did = d1.did
                                        AND p.Date = (
                                            SELECT MAX(p2.date)
                                                FROM ip p2
                                                WHERE p2.did = d1.did

                                        )
                                )

                        )");
$query->bindValue(":uid", $_SESSION["uid"]);
$query->execute();
$info['data']= [];

while ($device = $query->fetch())
{

    $date = new DateTime($device['Date']);


        $info['data'][] = array(
            "did"         => $device["did"],
            "Name"         => $device["Name"],
            "Location"         => $device["Location"],
            "Date" => $date->format("l, F j, Y @ h:i:sa"),
            "IP"    => $device["IP"],

        );



}

echo json_encode($info);