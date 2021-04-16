<?php

namespace api\v1;

use libs\Mysqllib;
use db\Database;
use models\Document;

class ManageDocument
{
    public static function gets(String $type)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from `$type`");
        return $res;
    }

    public static function getByCode(String $code, String $type)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $res = Mysqllib::mysql_get_data_from_query($conn, "SELECT * from `$type` WHERE code='$code'");
        return $res;
    }

    public static function post(Document $document, String $type)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        switch ($type) {
            case 'book':
                $query = sprintf(
                    "INSERT INTO `book`(`code`, `publisher`, `releaseNumber`, `author`, `numberPage`) VALUES ( '%s', '%s', '%s', '%s', '%s' )",
                    $document->code,
                    $document->publisher,
                    $document->releaseNumber,
                    $document->author,
                    $document->numberPage
                );
                break;

            case 'journal':
                $query = sprintf(
                    "INSERT INTO `journal`(`code`, `publisher`, `releaseNumber`, `issueNumber`, `monthIssue`) VALUES ( '%s', '%s', '%s', '%s', '%s' )",
                    $document->code,
                    $document->publisher,
                    $document->releaseNumber,
                    $document->issueNumber,
                    $document->monthIssue
                );
                break;

            case 'newspaper':
                $query = sprintf(
                    "INSERT INTO `newspaper`(`code`, `publisher`, `releaseNumber`, `dayIssue`) VALUES ( '%s', '%s', '%s', '%s' )",
                    $document->code,
                    $document->publisher,
                    $document->releaseNumber,
                    $document->dayIssue
                );
                break;

            default:
                $query = sprintf(
                    "INSERT INTO `book`(`code`, `publisher`, `releaseNumber`, `author`, `numberPage`) VALUES ( '%s', '%s', '%s', '%s', '%s' )",
                    $document->code,
                    $document->publisher,
                    $document->releaseNumber,
                    $document->author,
                    $document->numberPage
                );
                break;
        }

        $res = Mysqllib::mysql_post_data_from_query($conn, $query);

        return $res;
    }

    public static function update(Document $document, String $type, String $code)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        switch ($type) {
            case 'book':
                $query = sprintf("UPDATE `book` SET `code`='$document->code',`publisher`=`$document->publisher`,`releaseNumber`=$document->releaseNumber,`author`=`$document->author`,`numberPage`=$document->numberPage WHERE `code`='$code'");
                break;

            case 'journal':
                $query = sprintf("UPDATE `book` SET `code`='$document->code',`publisher`=`$document->publisher`,`releaseNumber`=$document->releaseNumber,`issueNumber`=$document->issueNumber,`numberPage`=`$document->monthIssue` WHERE `code`='$code'");
                break;

            case 'newspaper':
                $query = sprintf("UPDATE `book` SET `code`='$document->code',`publisher`=`$document->publisher`,`releaseNumber`=$document->releaseNumber,`dayIssue`=`$document->dayIssue`, WHERE `code`='$code'");
                break;

            default:
                $query = sprintf("UPDATE `book` SET `code`='$document->code',`publisher`=`$document->publisher`,`releaseNumber`=$document->releaseNumber,`author`=`$document->author`,`numberPage`=$document->numberPage WHERE `code`='$code'");
                break;
        }
        $res = Mysqllib::mysql_post_data_from_query($conn, $query);
        return $res;
    }

    public static function deleteByCode(String $code, String $type)
    {
        // Connect db
        $conn_resp = Database::connect_db();
        if (!$conn_resp->status) {
            return $conn_resp;
        }
        $conn = $conn_resp->message;
        // Query
        $query = "DELETE FROM `$type` WHERE `code`='$code'";

        $res = Mysqllib::mysql_post_data_from_query($conn, $query);

        return $res;
    }

}
