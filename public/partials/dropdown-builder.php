<?php if ( $get_data ) : ?>
  <p>Builders</p>
  <select name="builders" class="search-query tm-search-filter-select-builder search-builder" data-request="search-builder">
    <option value="-1"  data-term-id="-1" data-slug="-1" <?php echo ($builders == -1) ? 'selected':'';?> >
      Any
    </option>
    <?php foreach ( $get_data as $k => $v ) : ?>
      <option value="<?php echo $v['slug'];?>" data-term-id="<?php echo $v['id'];?>" data-slug="<?php echo $v['slug'];?>" <?php echo ($builders == $v['slug']) ? 'selected':'';?>>
        <?php echo $v['name'];?>
      </option>
    <?php endforeach; ?>
  </select>
<?php endif; ?>
