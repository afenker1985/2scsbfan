<?php
	class MyDB extends SQLite3
	{
	   function __construct()
	   {
		   $this->open($_ENV['OPENSHIFT_DATA_DIR'] . '/2scsb.db');
	   }
	}
?>