<?php header('Content-type: application/xml; charset="ISO-8859-1"', true);  ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

   <url>
      <loc><?= base_url() ?></loc>
      <priority>1.0</priority>
   </url>

   <?php foreach ($produk as $data) {
      $originalDate = $data['waktu_input'];
      $newDate = date("Y-m-d", strtotime($originalDate));
   ?>

      <url>

         <loc><?= base_url('produk/detail/') . $data['produk_seo']; ?></loc>

         <lastmod><?php echo $newDate ?></lastmod>

         <priority>0.8</priority>

      </url>

   <?php } ?>

   <?php foreach ($artikel as $row) {
      $originalDate2 = $row['waktu_input'];
      $newDate2 = date("Y-m-d", strtotime($originalDate2));
   ?>

      <url>

         <loc><?= base_url('artikel/detail/') . $row['judul_seo']; ?></loc>

         <lastmod><?php echo $newDate2 ?></lastmod>

         <priority>0.8</priority>

      </url>

   <?php } ?>

</urlset>