<?php
header::toxml();
echo('<?xml version="1.0" encoding="UTF-8"?>');
?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>http://<?php echo(safe::string($_SERVER["HTTP_HOST"])); ?></loc>
        <lastmod><?php echo(date('Y-m-d',strtotime('yesterday'))); ?>T12:34:44+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?php echo(url('contact')); ?></loc>
        <lastmod><?php echo(date('Y-m-d')); ?>T00:00:00+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc><?php echo(url('users')); ?></loc>
        <lastmod><?php echo(date('Y-m-d')); ?>T00:00:00+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc><?php echo(url('fal')); ?></loc>
        <lastmod><?php echo(date('Y-m-d')); ?>T00:00:00+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc><?php echo(url('game')); ?></loc>
        <lastmod><?php echo(date('Y-m-d',strtotime('yesterday'))); ?>T12:34:44+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc><?php echo(url('player')); ?></loc>
        <lastmod><?php echo(date('Y-m-d', strtotime('yesterday'))); ?>T12:34:44+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc><?php echo(url('love')); ?></loc>
        <lastmod><?php echo(date('Y-m-d',strtotime('yesterday'))); ?>T12:34:44+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc><?php echo url("resetpw"); ?></loc>
        <lastmod><?php echo(date('Y-m-d',strtotime('yesterday'))); ?>T12:34:44+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?php echo url("register"); ?></loc>
        <lastmod><?php echo(date('Y-m-d',strtotime('yesterday'))); ?>T12:34:44+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.80</priority>
    </url>
</urlset>