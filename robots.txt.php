<?php
    header::totxt();
?>
User-agent: *
Disallow: /theme/
Sitemap: http://<?php echo(safe::string($_SERVER["HTTP_HOST"])); ?>/sitemap.xml