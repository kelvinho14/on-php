<?
/*******************************************************************************
** Title.........: download class demo file                                   **
** Summary.......: This class demonstrates the use of class.download.inc      **
** Version.......: 1.0.0                                                      **
** Author........: Klaus P. Pieper <klaus_p.pieper@t-online.de>               **
** Project home..: http://klaus_p.pieper.bei.t-online.de/                     **
** Filename......: download.demo.php                                          **
** Copyright(C)..: 2002 Klaus P. Pieper                                       **
** Last changed..: 28 August 2002                                             **
** License.......: GNU Lesser General Public License (see below)              **
**                                                                            **
**  This library is free software; you can redistribute it and/or             **
**  modify it under the terms of the GNU Lesser General Public                **
**  License as published by the Free Software Foundation; either              **
**  version 2.1 of the License, or (at your option) any later version.        **
**                                                                            **
**  This library is distributed in the hope that it will be useful,           **
**  but WITHOUT ANY WARRANTY; without even the implied warranty of            **
**  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU         **
**  Lesser General Public License for more details.                           **
                                                                              **
**  You should have received a copy of the GNU Lesser General Public          **
**  License along with this library; if not, write to the Free Software       **
**  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA **
*******************************************************************************/

/*******************************************************************************
**  Version history:
**  1.0.0: 28-Aug-2002: first published version
*******************************************************************************/

require_once("class.download.inc");

    if (!isset($_GET["file"])) {
        echo "<h4>call http://servername/path/download.demo.php?file=(filename)[&name=(download name)]" .
             "[&ct=(compression threshold)]<br><br><br>".
             "to download the demo file, call<br><br>".
             "http://servername/path/download.demo.php?file=download.demo.php<br><br><br>".
             "to download the demo file under a different name, call<br><br>".
             "http://servername/path/download.demo.php?file=download.demo.php&name=myName.doc<br><br><br>".
             "to download the demo file compressed, call<br><br>".
             "http://servername/path/download.demo.php?file=download.demo.php&ct=100</h4>";
        exit();
    } /* endif */

    download::dlFile($_GET["file"], $_GET["name"], NULL, $_GET["ct"]);

    exit();

    // end of file.
?>