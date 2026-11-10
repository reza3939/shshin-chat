<?php
class uploadFile
{
    private $ftp_host;
    private $ftp_username;
    private $ftp_password;
    private $ftp_connection = false;
    private $ftp_connection_id = false;
    public function __construct($data)
    {
        $this->ftp_host     = $data;
        $this->ftp_username = 'profile@roida.ir';
        $this->ftp_password = 'RnCk28fJ6';
        $this->connection();
    }
    private function connection()
    {
        if ($this->ftp_connection == false) {
            $conn_id = ftp_connect($this->ftp_host);
            if (!$conn_id) {
                throw new Exception("Couldn't connect to Ftp Host.");
            }
            ftp_pasv($conn_id, true);
            if (!ftp_login($conn_id, $this->ftp_username, $this->ftp_password)) {
                throw new Exception("Couldn't Login to Ftp Host.");
            }
            $this->ftp_connection    = true;
            $this->ftp_connection_id = $conn_id;
        }
    }
    public function upload($dir, $file, $name)
    {
        global $up_path;
        if ($this->ftp_connection == false) {
            $this->connection();
        }
        if (ftp_nlist($this->ftp_connection_id, $up_path) == false) {
            ftp_mkdir($this->ftp_connection_id, $up_path);
        }
        if (ftp_nlist($this->ftp_connection_id, $up_path . '/' . $dir) == false) {
            ftp_mkdir($this->ftp_connection_id, $up_path . '/' . $dir);
        }
        $destination_file = $up_path . '/' . $dir . '/' . $name;
        if (ftp_put($this->ftp_connection_id, $destination_file, $file, FTP_ASCII)) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($dir, $file)
    {
        global $up_path;
        if ($this->ftp_connection == false) {
            $this->connection();
        }
        $destination_file = $up_path . '/' . $dir . '/' . $file;
        if (ftp_delete($this->ftp_connection_id, $destination_file)) {
            return true;
        } else {
            return false;
        }
    }
    public function remdir($dir)
    {
        global $up_path;
        if ($this->ftp_connection == false) {
            $this->connection();
        }
        $destination_file = $up_path . '/' . $dir;
        $files            = ftp_nlist($this->ftp_connection_id, $destination_file);
        foreach ($files as $file) {
            @ftp_delete($this->ftp_connection_id, $file);
        }
        @ftp_rmdir($this->ftp_connection_id, $destination_file);
    }
	public function isfile($file)
    {
        global $up_path;
        if ($this->ftp_connection == false) {
            $this->connection();
        }
        $destination_file = $up_path . '/' . $file;
        $files            = ftp_size($this->ftp_connection_id, $destination_file);
        if($files != -1) {
			return true;
		} else {
			return false;
		}
    }
}
?>