<?php
/**
 * The search form.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<form role="search" method="post" id="searchform" action="<?php bloginfo('url'); ?>/">
    <label class="screen-reader-text" for="s">Search for:</label>
    <input type="text" value="Search..." name="s" id="s" placeholder="Search..." />
    <input type="submit" id="s-submit" name="submit" value="Go" />
</form>