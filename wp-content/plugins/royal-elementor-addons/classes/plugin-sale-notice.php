<?php 
namespace WprAddons\Classes;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WprPluginSaleNotice {
    public function __construct() {
        // delete_option('wpr_plugin_sale_dismiss_notice');
        
        $this->past_date = strtotime( '-2 days' );
        $this->install_date = get_option('royal_elementor_addons_activation_time_for_sale');

        if ( current_user_can('administrator') ) {
            if ( !get_option('wpr_plugin_sale_dismiss_notice') ) {
                add_action( 'admin_init', [$this, 'render_notice'] );
            }
        }

        if ( is_admin() ) {
            add_action( 'admin_head', [$this, 'enqueue_scripts' ] );
        }

        add_action( 'wp_ajax_wpr_plugin_sale_dismiss_notice', [$this, 'wpr_plugin_sale_dismiss_notice'] );
    }

    public function render_notice() {
        if ( $this->past_date >= $this->install_date ) {
            add_action( 'admin_notices', [$this, 'render_plugin_sale_notice' ]);
        }
    }
    
    public function wpr_plugin_sale_dismiss_notice() {
        add_option( 'wpr_plugin_sale_dismiss_notice', true );
    }

    public function render_plugin_sale_notice() {

        if ( is_admin() ) {
            echo '<div class="notice wpr-plugin-sale-notice is-dismissible">
                        <div class="wpr-plugin-sale-notice-logo">
                            <img src="'. esc_url(WPR_ADDONS_ASSETS_URL) .'/img/logo-128x128.png">
                        </div>
                        <div>
                            <h3><span>Flash Sale</span><br> Royal Elementor Addons Pro</h3>
                            <ul>
                                <li>
                                    <img src="'. esc_url(WPR_ADDONS_ASSETS_URL) .'/img/check-mark.png">
                                    Advanced Theme Builder
                                </li>
                                <li>
                                    <img src="'. esc_url(WPR_ADDONS_ASSETS_URL) .'/img/check-mark.png">
                                    20+ Designer Made Templates Kit
                                </li>
                                <li>
                                    <img src="'. esc_url(WPR_ADDONS_ASSETS_URL) .'/img/check-mark.png">
                                    35+ Advanced Elementor Widgets
                                </li>
                                <li>
                                    <img src="'. esc_url(WPR_ADDONS_ASSETS_URL) .'/img/check-mark.png">
                                    Advanced Popup Builder
                                </li>
                            </ul>
                            <p>
                                Hurry up! Upgrade within the <strong>next 24 hours</strong> and get a 
                                <strong>40% Discount</strong>.<br><br>
                                Use Promo Code: &nbsp;&nbsp;&nbsp;<strong style="border: 1px dashed #C3C4C7;padding: 2px 10px;">REAFLASH40</strong>
                            </p>
                            <br>
                            <div>
                                <a href="https://royal-elementor-addons.com/?ref=rea-plugin-backend-salebanner-upgrade-pro#purchasepro" target="_blank" class="wpr-upgrade-to-pro-button button button-secondary">Upgrade to Pro <span class="dashicons dashicons-arrow-right-alt"></span></a>
                            </div>
                        </div>
                        <div class="image-wrap"><img src="'. esc_url(WPR_ADDONS_ASSETS_URL) .'/img/sale-banner.png"></div>
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

            jQuery(document).on( 'click', '.wpr-plugin-sale-notice .notice-dismiss', function() {
                jQuery(document).find('.wpr-plugin-sale-notice').slideUp();
                jQuery.post({
                    url: ajaxurl,
                    data: {
                        action: 'wpr_plugin_sale_dismiss_notice',
                    }
                });
              }); 
            });
        </script>

        <style>
            .wpr-plugin-sale-notice {
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

            .wpr-plugin-sale-notice-logo {
                display: none;
                margin-right: 30px;
            }

            .wpr-plugin-sale-notice-logo img {
                max-width: 100%;
            }

            .wpr-plugin-sale-notice h3 {
                font-size: 36px;
                margin-top: 0;
                margin-bottom: 35px;
            }

            .wpr-plugin-sale-notice h3 span {
              display: inline-block;
              margin-bottom: 15px;
              font-size: 12px;
              color: #fff;
              background-color: #f51f3d;
              padding: 2px 12px 4px;
              border-radius: 3px;
            }

            .wpr-plugin-sale-notice ul li {
            }

            .wpr-plugin-sale-notice ul img {
                display: inline-block;
                width: 11px;
                margin-right: 2px;
            }

            .wpr-plugin-sale-notice p {
              margin-top: 10px;
              margin-bottom: 15px;
              font-size: 14px;
            }
            
            .wpr-plugin-sale-notice .wpr-upgrade-to-pro-button {
              border: 2px solid #6A4BFF;
              color: #6A4BFF;
                padding: 5px 25px;
                font-weight: bold;
                letter-spacing: 0.3px;
            }
            
            .wpr-plugin-sale-notice .wpr-upgrade-to-pro-button:hover {
              border: 2px solid #6A4BFF;
              color: #ffffff;
              background-color: #6A4BFF;
            }

            .wpr-plugin-sale-notice .wpr-upgrade-to-pro-button .dashicons {
              font-size: 14px;
              line-height: 30px;
            }
            
            .wpr-plugin-sale-notice .image-wrap {
              margin-left: auto;
            }

            #wpr-notice-confetti {
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              pointer-events: none;
            }

            .wpr-plugin-sale-notice .image-wrap img {
              
            }

            @media screen and (max-width: 1366px) {
                .wpr-plugin-sale-notice .image-wrap img {
                  zoom: 0.9;
                }
            }
        </style>";

        
    }
}

if ( 'Royal Addons' === Utilities::get_plugin_name() ) {
    new WprPluginSaleNotice();
}