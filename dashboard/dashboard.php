<?php

/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
?>
<div id="multidealer-steps3">
    <div class="multidealer-block-title">
        <img alt="aux" src="<?php echo esc_url(MULTIDEALERURL); ?>assets/images/3steps.png" />
        <br /><br />
        <?php echo esc_html__('Follow these 3 steps after installing the plugin:', 'multidealer'); ?>
    </div>
    <div class="multidealer-help-container1">
        <div class="multidealer-help-column multidealer-help-column-1">
            <img alt="aux" src="<?php echo esc_url(MULTIDEALERURL); ?>assets/images/step1.png" />
            <h3><?php echo esc_html__('Configure Settings', 'multidealer'); ?></h3>
            <?php echo esc_html__('Go to', 'multidealer'); ?><br />
            <?php echo esc_html__('Dashboard => MultiDealer => Settings', 'multidealer'); ?>
            <br />
            <em><?php echo esc_html__('Fill out the information:', 'multidealer'); ?></em>:
            <br />
            - <?php echo esc_html__('Your Currency', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('Miles - Km', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('Your Contact Email', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('And So On...', 'multidealer'); ?>
            <br />
        </div>
        <div class="multidealer-help-column multidealer-help-column-2">
            <img alt="aux" src="<?php echo esc_url(MULTIDEALERURL); ?>assets/images/step2.png" />
            <h3><?php echo esc_html__('Fill Out the Fields Table', 'multidealer'); ?></h3>
            <?php echo esc_html__('Go to:', 'multidealer'); ?><br />
            <?php echo esc_html__('Dashboard => MultiDealer => Fields Table', 'multidealer'); ?>
            <br />
            <?php echo esc_html__('These are the fields that will appear in your product form.', 'multidealer'); ?><br />
            <?php echo esc_html__('For example, if you are a Car Dealer, you might want to add:', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('Number of Passengers', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('Fuel Type', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('Engine HP', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('And So On...', 'multidealer'); ?>
            <br /><br /><br />
        </div>
        <div class="multidealer-help-column multidealer-help-column-3">
            <img alt="aux" src="<?php echo esc_url(MULTIDEALERURL); ?>assets/images/step3.png" />
            <h3><?php echo esc_html__('Fill Out Products Table', 'multidealer'); ?></h3>
            <?php echo esc_html__('Go to:', 'multidealer'); ?><br />
            <?php echo esc_html__('Dashboard => MultiDealer => Products Table', 'multidealer'); ?>
            <br />
            <?php echo esc_html__('Fill out this table with your products.', 'multidealer'); ?>
            <br />
            <?php echo esc_html__('For example:', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('Cars', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('Boats', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('Aircrafts', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('Real Estate', 'multidealer'); ?>
            <br />
            - <?php echo esc_html__('And So On...', 'multidealer'); ?>
            <br /><br />
            <?php echo esc_html__('After that, copy and paste this code to your page:', 'multidealer'); ?>
            [multi_dealer]
            <br /><br />
            <?php echo esc_html__('Set Permalinks to Post Name', 'multidealer'); ?><br />
            (<?php echo esc_html__('Dashboard => Settings => Permalink', 'multidealer'); ?>).
        </div>
    </div>
</div>
<div id="multidealer-services3">
    <div class="multidealer-block-title">
        <?php echo esc_html__('Help, Support, Troubleshooting:', 'multidealer'); ?>
    </div>
    <div class="multidealer-help-container1">
        <div class="multidealer-help-column multidealer-help-column-1">
            <img alt="aux" src="<?php echo esc_url(MULTIDEALERURL); ?>assets/images/support.png" />
            <h3><?php echo esc_html__('Help and More Tips', 'multidealer'); ?></h3>
            <?php echo esc_html__('Just click the HELP button at the top right corner of this page for context help. Also, tooltips are available in the Fields form.', 'multidealer'); ?>
            <br /><br />
        </div>
        <div class="multidealer-help-column multidealer-help-column-2">
            <img alt="aux" src="<?php echo esc_url(MULTIDEALERURL); ?>assets/images/service_configuration.png" />
            <h3><?php echo esc_html__('Online Guide, Support, Demo Video, FAQ...', 'multidealer'); ?></h3>
            <?php echo esc_html__('You will find our complete and updated online guide, demo video, FAQ page, support links, and more useful resources on our website.', 'multidealer'); ?>
            <br /><br />
            <?php $site = 'http://multidealerplugin.com'; ?>
            <a href="<?php echo esc_url($site); ?>" class="button button-primary"><?php echo esc_html__('Go', 'multidealer'); ?></a>
        </div>
        <div class="multidealer-help-column multidealer-help-column-3">
            <img alt="aux" src="<?php echo esc_url(MULTIDEALERURL); ?>assets/images/system_health.png" />
            <h3><?php echo esc_html__('Troubleshooting Guide', 'multidealer'); ?></h3>
            <?php echo esc_html__('Issues such as using an old WordPress version, low memory, plugins with JavaScript errors, or incorrect permalink settings can cause problems. Read this guide to quickly fix them!', 'multidealer'); ?>
            <br /><br />
            <a href="http://siterightaway.net/troubleshooting/" class="button button-primary"><?php echo esc_html__('Troubleshooting Page', 'multidealer'); ?></a>
        </div>
    </div>
</div>