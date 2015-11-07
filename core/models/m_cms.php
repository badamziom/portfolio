<?php

class Cms {

    private $AdamCms;

    function __construct() {
        global $AdamCms;
        $this->AdamCms = & $AdamCms;
    }

    function updateInformation($id, $content, $type) {
        if ($stmt = $this->AdamCms->Database->prepare("UPDATE  description SET content = ? , type = ? WHERE id = ?")) {
            $stmt->bind_param('ssi', $content, $type, $id);
            $stmt->execute();
            $stmt->close();
        }
    }

    function deleteInformation($id) {
        if ($stmt = $this->AdamCms->Database->prepare("DELETE FROM description WHERE id = ?")) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->close();
        }
    }

    function insertInformation($content, $type) {
        if ($stmt = $this->AdamCms->Database->prepare("INSERT INTO description (content, type) VALUES (? ,?)")) {
            $stmt->bind_param('ss', $content, $type);
            $stmt->execute();
            $stmt->close();
        }
    }

    function insertWork($content, $address, $image, $tmp_image, $imagename) {
        if ($stmt = $this->AdamCms->Database->prepare("INSERT INTO works (content, address, image, imagename) VALUES (?, ?, ?, ?)")) {
            $stmt->bind_param('ssss', $content, $address, $image, $imagename);
            $stmt->execute();
            $stmt->close();
            move_uploaded_file($tmp_image, APP_PATH . 'images/' . $image);
            @unlink($tmp_image);
        }
    }

    function updateWork($id, $content, $address, $image, $tmp_image, $lastimage, $imagename) {

        if ($stmt = $this->AdamCms->Database->prepare("UPDATE  works SET content = ?, address= ?, image= ?, imagename= ? WHERE id = ?")) {
            if (!(empty($image))) {
                if ($image != $lastimage) {
                    move_uploaded_file($tmp_image, APP_PATH . 'images/' . $image);
                    @unlink(APP_PATH . 'images/' . $lastimage);
                    @unlink($tmp_image);
                }
                $stmt->bind_param('ssssi', $content, $address, $image, $imagename, $id);
            } else {
                $stmt->bind_param('ssssi', $content, $address, $lastimage, $imagename, $id);
            }
            $stmt->execute();
            $stmt->close();
        }
    }

    function deleteWork($id, $image) {
        if ($stmt = $this->AdamCms->Database->prepare("DELETE FROM works WHERE id = ?")) {
            @unlink(APP_PATH . 'images/' . $image);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->close();
        }
    }

}
