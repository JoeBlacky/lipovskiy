<?php
	$enabled  = get_field('map_enabled');
  $map      = getAdditionalBlock('map');
  $mapID    = $map->ID;
  $lat      = get_field('lat', $mapID);
  $lng      = get_field('lng', $mapID);
  $pin      = get_field('pin', $mapID);
  $mapInfo  = get_bloginfo();
?>
<?php if($enabled): ?>
  <div
    id="map"
    class="map"
    data-lat="<?php echo $lat; ?>"
    data-lng="<?php echo $lng; ?>"
    data-pin="<?php echo $pin; ?>"
    data-info="<?php echo $mapInfo; ?>"
  ></div>
<?php endif; ?>