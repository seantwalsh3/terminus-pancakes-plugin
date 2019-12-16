<?php

namespace Pantheon\TerminusPancakes\Apps;

/**
 * Open Site database in TablePlus
 */
class TablePlusApp extends PancakesApp {

  /**
   * {@inheritdoc}
   */
  public $aliases = ['tableplus'];

  /**
   * {@inheritdoc}
   */
  public $app = 'TablePlus';

  /**
   * Open Site database in TablePlus
   */
  public function open() {
    $url = $this->getTablePlusOpenUrl();
    $tempfile = $this->writeFile($url, 'text');
    $this->execCommand('open', $tempfile);
  }

  /**
   * Validates the app can be used
   */
  public function validate() {
    return php_uname('s') === 'Darwin';
  }

  /**
   * Gets the url for opening a connection in TablePlus
   */
  private function getTablePlusOpenUrl() {
    $label = htmlspecialchars($this->connection_info['site_label']);
    $mysql_host = htmlspecialchars($this->connection_info['mysql_host']);
    $mysql_port = htmlspecialchars($this->connection_info['mysql_port']);
    $mysql_username = htmlspecialchars($this->connection_info['mysql_username']);
    $mysql_password = htmlspecialchars($this->connection_info['mysql_password']);
    $mysql_database = htmlspecialchars($this->connection_info['mysql_database']);

    return 'mariadb://'. $mysql_username . ':' . $mysql_password . '@' . $mysql_host . ':' . $mysql_port . '/' . $mysql_database;
  }

}
