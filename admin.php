<?php
session_start();

//Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'] ?? '';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="icon" type="image/x-icon" href="/img/icon.png">
    <link rel="stylesheet" href="/css/pico.classless.red.min.css">
    <link rel="stylesheet" href="/css/pico.colors.min.css">
    <title>Admin Page</title>
  </head>

  <body>
    <!-- Header -->
    <header>
      <nav>
        <ul>
          <li><a href="#" data-theme-switcher="auto">Auto</a></li>
          <li><a href="#" data-theme-switcher="light">Light</a></li>
          <li><a href="#" data-theme-switcher="dark">Dark</a></li>
        </ul>
      </nav>
      <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
        </ul>
        <ul>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>
    <!-- ./ Header -->

    <!-- Body -->
    <main>
        <h2>Docker Server Addresses</h2>
        <strong>Local Ip (192.168.2.21)</strong>
        <ul>
            <article>
                <article>
                    <header>
                        <img src="img/plex.jpg" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Plex</strong>
                    </header>
                    <p>
                        <a href="http://192.168.2.21:32400" target="_blank">http://192.168.2.21:32400</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/prowlarr.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Prowlarr</strong>
                    </header>
                    <p>
                        <a href="http://192.168.2.21:9696" target="_blank">http://192.168.2.21:9696</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/radarr.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Radarr</strong>
                    </header>
                    <p>
                        <a href="http://192.168.2.21:7878" target="_blank">http://192.168.2.21:7878</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/sabnzbd.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">SabNZBd</strong>
                    </header>
                    <p>
                        <a href="http://192.168.2.21:8081" target="_blank">http://192.168.2.21:8081</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/sonarr.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Sonarr</strong>
                    </header>
                    <p>
                        <a href="http://192.168.2.21:8989" target="_blank">http://192.168.2.21:8989</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/tautulli.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Tautulli</strong>
                    </header>
                    <p>
                        <a href="http://192.168.2.21:8181" target="_blank">http://192.168.2.21:8181</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/qbittorrent.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Qbittorrent (Not in use)</strong>
                    </header>
                    <p>
                        <a href="http://192.168.2.21:8081" target="_blank">http://192.168.2.21:8081</a>
                    </p>
                </article>
        </ul>
        <strong>Public Ip (142.189.68.126)</strong>
        <ul>
            <article>
                <article>
                    <header>
                        <img src="img/plex.jpg" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Plex</strong>
                    </header>
                    <p>
                        <a href="http://142.189.68.126:32400" target="_blank">http://142.189.68.126:32400</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/prowlarr.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Prowlarr</strong>
                    </header>
                    <p>
                        <a href="http://142.189.68.126:9696" target="_blank">http://142.189.68.126:9696</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/radarr.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Radarr</strong>
                    </header>
                    <p>
                        <a href="http://142.189.68.126:7878" target="_blank">http://142.189.68.126:7878</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/sabnzbd.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">SabNZBd</strong>
                    </header>
                    <p>
                        <a href="http://142.189.68.126:8081" target="_blank">http://142.189.68.126:8081</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/sonarr.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Sonarr</strong>
                    </header>
                    <p>
                        <a href="http://142.189.68.126:8989" target="_blank">http://142.189.68.126:8989</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/tautulli.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Tautulli</strong>
                    </header>
                    <p>
                        <a href="http://142.189.68.126:8181" target="_blank">http://142.189.68.126:8181</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/qbittorrent.png" style="vertical-align: middle; width: 30px; height: 30px;">
                        <strong style="margin-left: 10px;">Qbittorrent (Not in use)</strong>
                    </header>
                    <p>
                        <a href="http://142.189.68.126:8081" target="_blank">http://142.189.68.126:8081</a>
                    </p>
                </article>
        </ul>
        <strong>Docker Links</strong>
        <ul>
                <article>
                    <header>
                        <img src="img/docker.png" style="vertical-align: middle; width: auto; height: 30px;">
                        <strong style="margin-left: 10px;">Docker Hub</strong>
                    </header>
                    <p>
                        <a href="https://hub.docker.com/" target="_blank">https://hub.docker.com/</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/linuxserver.png" style="vertical-align: middle; width: auto; height: 30px;">
                        <strong style="margin-left: 10px;">LinuxServer Docs</strong>
                    </header>
                    <p>
                        <a href="https://docs.linuxserver.io/" target="_blank">https://docs.linuxserver.io/</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/servarr.png" style="vertical-align: middle; width: auto; height: 30px;">
                        <strong style="margin-left: 10px;">Servarr Wiki</strong>
                    </header>
                    <p>
                        <a href="https://wiki.servarr.com/" target="_blank">https://wiki.servarr.com/</a>
                    </p>
                </article>
        </ul>
        <strong>Usenet Links</strong>
        <ul>
                <article>
                    <header>
                        <img src="img/nzbgeek.png" style="vertical-align: middle; width: auto; height: 30px;">
                        <strong style="margin-left: 10px;">NzbGeek</strong>
                    </header>
                    <p>
                        <a href="https://nzbgeek.info/" target="_blank">https://nzbgeek.info/</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/usenet.png" style="vertical-align: middle; width: auto; height: 30px;">
                        <strong style="margin-left: 10px;">Usenet Express</strong>
                    </header>
                    <p>
                        <a href="https://members.usenetexpress.com/member" target="_blank">https://members.usenetexpress.com/member</a>
                    </p>
                </article>
        </ul>
        <strong>Website Links</strong>
        <ul>
                <article>
                    <header>
                        <img src="img/gettech.png" style="vertical-align: middle; width: auto; height: 30px;">
                        <strong style="margin-left: 10px;">.Tech Domain</strong>
                    </header>
                    <p>
                        <a href="https://get.tech/" target="_blank">https://get.tech/</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/nginx.svg" style="vertical-align: middle; width: auto; height: 30px;">
                        <strong style="margin-left: 10px;">Nginx Documentation</strong>
                    </header>
                    <p>
                        <a href="https://nginx.org/en/docs/" target="_blank">https://nginx.org/en/docs/</a>
                    </p>
                </article>
                <article>
                    <header>
                        <img src="img/pico.png" style="vertical-align: middle; width: auto; height: 30px;">
                        <strong style="margin-left: 10px;">Pico CSS Documentation</strong>
                    </header>
                    <p>
                        <a href="https://picocss.com/docs" target="_blank">https://picocss.com/docs</a>
                    </p>
                </article>
        </ul>
    </main>
    <footer>
      <hr>
      <small>&copy; 2025 Levi McLean</small>
      <br>
      <small>Built with 
        <a href="https://picocss.com">Pico</a> | <a href="https://github.com/LeviM-0323/Personal-Website" target="_blank">Source</a>
      </small>
    </footer>
    <script src="/js/minimal-theme-switcher.js"></script>
  </body>
</html>