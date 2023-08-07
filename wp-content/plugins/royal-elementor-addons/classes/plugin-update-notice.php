<?php 
namespace WprAddons\Classes;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WprPluginUpdateNotice {
    public function __construct() {

        if ( current_user_can('administrator') ) {

            if ( !get_option('wpr_plugin_update_dismiss_notice_' . get_plugin_data(WPR_ADDONS__FILE__)['Version']) ) {
                add_action( 'admin_init', [$this, 'render_notice'] );
            }
        }

        if ( is_admin() ) {
            add_action( 'admin_head', [$this, 'enqueue_scripts' ] );
        }

        add_action( 'wp_ajax_wpr_plugin_update_dismiss_notice', [$this, 'wpr_plugin_update_dismiss_notice'] );
    }

    public function render_notice() {
        add_action( 'admin_notices', [$this, 'render_plugin_update_notice' ]);
    }
    
    public function wpr_plugin_update_dismiss_notice() {
        add_option( 'wpr_plugin_update_dismiss_notice_' . get_plugin_data(WPR_ADDONS__FILE__)['Version'], true );
    }

    public function render_plugin_update_notice() {
        global $current_screen;

        if ( is_admin() ) {
            if ( 'royal-addons_page_wpr-templates-kit' === $current_screen->id || 'update' === $current_screen->id ) {
                return;
            }

            echo '<div class="notice wpr-plugin-update-notice is-dismissible">
                        <div class="wpr-plugin-update-notice-logo">
                            <img src="'. esc_url(WPR_ADDONS_ASSETS_URL) .'/img/logo-128x128.png">
                        </div>
                        <div>
                            <h3><span>New Feature</span><br> Royal WooCommerce Builder</h3>
                            <p>
                                Royal Elementor WooCommerce Builder lets you customize every fundamental part of your WooCommerce site without coding. Including your Header, Footer, Product Archives, Products, Post Archives, Posts, Default Pages, 404 Pages, etc..
                                <br><br><strong>New Woo Builder Template Kits:</strong>
                                <a href="https://demosites.royal-elementor-addons.com/wooshop-v1/?ref=rea-plugin-backend-update-notice" target="_blank">WooShop</a>, 
                                <a href="https://demosites.royal-elementor-addons.com/fashion-v1/?ref=rea-plugin-backend-update-notice" target="_blank">Fashion</a>, 
                                <a href="https://demosites.royal-elementor-addons.com/furniture-shop-v1/?ref=rea-plugin-backend-update-notice" target="_blank">Furniture Shop</a>, 
                                <a href="https://demosites.royal-elementor-addons.com/grocery-store-v1/?ref=rea-plugin-backend-update-notice" target="_blank">Grocery Store</a>.
                            </p>
                            <br>
                            <div>
                                <a href="'. esc_url(get_admin_url()) .'admin.php?page=wpr-templates-kit" class="wpr-get-started-button button button-primary">Go to Templates Library</a>
                                <a href="'. esc_url(get_admin_url()) .'admin.php?page=wpr-theme-builder&tab=wpr_tab_product_archive" class="wpr-get-started-button button button-secondary">Go to WooCommerce Builder</a>
                            </div>
                        </div>
                        <div class="image-wrap"><img src="'. esc_url(WPR_ADDONS_ASSETS_URL) .'/img/new-theme-builder.png"></div>
                        <canvas id="wpr-notice-confetti"></canvas>
                </div>';
        }
    }
    
    public static function enqueue_scripts() {
        // Load Confetti
        wp_enqueue_script( 'wpr-confetti-js', WPR_ADDONS_URL .'assets/js/admin/lib/confetti/confetti.min.js', ['jquery'] );

        // Scripts & Styles
        echo "
        <script>
        jQuery( document ).ready( function() {

            if ( jQuery('#wpr-notice-confetti').length ) {
                const wprConfetti = confetti.create( document.getElementById('wpr-notice-confetti'), {
                    resize: true
                });

                setTimeout( function () {
                    wprConfetti( {
                        particleCount: 150,
                        origin: { x: 1, y: 2 },
                        gravity: 0.3,
                        spread: 50,
                        ticks: 150,
                        angle: 120,
                        startVelocity: 60,
                        colors: [
                            '#0e6ef1',
                            '#f5b800',
                            '#ff344c',
                            '#98e027',
                            '#9900f1',
                        ],
                    } );
                }, 500 );

                setTimeout( function () {
                    wprConfetti( {
                        particleCount: 150,
                        origin: { x: 0, y: 2 },
                        gravity: 0.3,
                        spread: 50,
                        ticks: 200,
                        angle: 60,
                        startVelocity: 60,
                        colors: [
                            '#0e6ef1',
                            '#f5b800',
                            '#ff344c',
                            '#98e027',
                            '#9900f1',
                        ],
                    } );
                }, 900 );
            }

            jQuery(document).on( 'click', '.wpr-plugin-update-notice .notice-dismiss', function() {
                jQuery(document).find('.wpr-plugin-update-notice').slideUp();
                console.log('works update dismiss');
                jQuery.post({
                    url: ajaxurl,
                    data: {
                        action: 'wpr_plugin_update_dismiss_notice',
                    }
                });
              }); 
            });
        </script>

        <style>
            .wpr-plugin-update-notice {
                position: relative;
                display: flex;
                align-items: center;
                margin-top: 20px;
                margin-bottom: 20px;
                padding: 30px;
                border: 0 !important;
                box-shadow: 0 0 5px rgb(0 0 0 / 0.1);

                padding-left: 40px;
            }

            .wpr-plugin-update-notice-logo {
                display: none;
                margin-right: 30px;
            }

            .wpr-plugin-update-notice-logo img {
                max-width: 100%;
            }

            .wpr-plugin-update-notice h3 {
                font-size: 36px;
                margin-top: 0;
                margin-bottom: 35px;
            }

            .wpr-plugin-update-notice h3 span {
              display: inline-block;
              margin-bottom: 15px;
              font-size: 12px;
              color: #fff;
              background-color: #f51f3d;
              padding: 2px 12px 4px;
              border-radius: 3px;
            }

            .wpr-plugin-update-notice p {
              margin-top: 10px;
              margin-bottom: 15px;
              font-size: 14px;
            }

            .wpr-get-started-button.button-primary {
            background-color: #6A4BFF;
            }

            .wpr-get-started-button.button-primary:hover {
            background-color: #583ed7;
            }

            .wpr-get-started-button.button-secondary {
            border: 2px solid #6A4BFF;
            color: #6A4BFF;
            }

            .wpr-get-started-button.button-secondary:hover {
            background-color: #6A4BFF;
            border: 2px solid #6A4BFF;
            color: #fff;
            }

            .wpr-get-started-button {
                padding: 5px 25px !important;
            }

            .wpr-get-started-button .dashicons {
              font-size: 12px;
              line-height: 28px;
            }
            
            .wpr-plugin-update-notice .image-wrap {
              margin-left: auto;
            }

            .wpr-plugin-update-notice .image-wrap img {
              zoom: 0.45;
            }

            @media screen and (max-width: 1366px) {
                .wpr-plugin-update-notice .image-wrap img {
                  zoom: 0.4;
                }
            }

            #wpr-notice-confetti {
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              pointer-events: none;
            }
        </style>";

        
    }
}

if ( 'Royal Addons' === Utilities::get_plugin_name() ) {
    new WprPluginUpdateNotice();
}