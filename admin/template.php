<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="wrap">
    <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="banae-widget-settings-form"
        name="banae-widget-settings-form">
        <div class="banae-magic">
            <div class="banae-admin-header">
                <div class="banae-admin-header-left">
                    <div class="banae-admin-logo-inline">
                        <i class="icofont-banana"></i>
                    </div>
                    <h2 class="title">Banana Addons</h2>
                </div>
                <div class="banae-admin-header-right">
                    <button type="button" id="banae-save-settings" class="button banae-button">
                        <svg class="banae-button-loading" width="60" height="20" viewBox="0 0 120 30">
                            <circle cx="30" cy="15" r="10" fill="#335705">
                                <animate attributeName="cy" from="15" to="15" dur="0.6s" begin="0s"
                                    repeatCount="indefinite" values="15;5;15" keyTimes="0;0.5;1"></animate>
                            </circle>
                            <circle cx="60" cy="15" r="10" fill="#335705">
                                <animate attributeName="cy" from="15" to="15" dur="0.6s" begin="0.2s"
                                    repeatCount="indefinite" values="15;5;15" keyTimes="0;0.5;1"></animate>
                            </circle>
                            <circle cx="90" cy="15" r="10" fill="#335705">
                                <animate attributeName="cy" from="15" to="15" dur="0.6s" begin="0.4s"
                                    repeatCount="indefinite" values="15;5;15" keyTimes="0;0.5;1"></animate>
                            </circle>
                        </svg>
                        <span class="banae-button-label">Save Setting</span>
                    </button>
                </div>
            </div>
            <div class="banae-widgets-admin-wrapper">
                <div class="banae-tabs banae-tabs-style-underline">
                    <nav class="tabs-navbar">
                        <ul>
                            <li
                                class="<?php echo ( empty( $Helper::get_active_hash() ) ) ? 'banae-tab-current' : ''; ?>">
                                <a href=" #banae-tab-get-started" class="banae-tab"><span><i
                                            class="icofont-globe"></i>Discover</span></a>
                            </li>
                            <li
                                class="<?php echo ( $Helper::get_active_hash() === 'widgets' ) ? 'banae-tab-current' : ''; ?>">
                                <a href="#banae-tab-widgets" class="banae-tab"><span><i
                                            class="icofont-duotone icofont-category"></i>Manage
                                        Widgets</span></a>
                            </li>
                            <li
                                class="<?php echo ( $Helper::get_active_hash() === 'extensions' ) ? 'banae-tab-current' : ''; ?>">
                                <a href="#banae-tab-extensions" class="banae-tab"><span><i
                                            class="icofont-duotone icofont-cube"></i>Manage
                                        Extensions</span></a>
                            </li>
                            <li
                                class="<?php echo ( $Helper::get_active_hash() === 'api-key' ) ? 'banae-tab-current' : ''; ?>">
                                <a href=" #banae-tab-manage-api" class="banae-tab"><span><i
                                            class="icofont-duotone icofont-screwdriver"></i>Manage API Keys</span></a>
                            </li>
                            <li><a href="#banae-tab-support" class="banae-tab"><span><i
                                            class="icofont-duotone icofont-support"></i>Help &
                                        Supports</span></a></li>
                        </ul>
                    </nav>
                </div>

                <div class="banae-content-wrap">
                    <section id="banae-tab-get-started"
                        class="banae-tab-content <?php echo ( empty( $Helper::get_active_hash() ) ) ? 'banae-active' : ''; ?>">
                        <?php $Helper::get_banae_template_part( 'admin/partials/hero-section' ); ?>
                    </section>
                    <section id="banae-tab-widgets"
                        class="banae-tab-content <?php echo ( $Helper::get_active_hash() === 'widgets' ) ? 'banae-active' : ''; ?>">
                        <?php $Helper::get_banae_template_part( 'admin/partials/setting-widgets', [ 'banae_widget_options' => $banae_widget_options, 'options' => $options ] ); ?>
                    </section>
                    <section id="banae-tab-extensions"
                        class="banae-tab-content <?php echo ( $Helper::get_active_hash() === 'extensions' ) ? 'banae-active' : ''; ?>">
                        <?php $Helper::get_banae_template_part( 'admin/partials/setting-extensions', [ 'banae_extension_options' => $banae_extension_options, 'options' => $extension_options ] ); ?>
                    </section>
                    <section id="banae-tab-manage-api"
                        class="banae-tab-content <?php echo ( $Helper::get_active_hash() === 'api-key' ) ? 'banae-active' : ''; ?>">
                        <?php $Helper::get_banae_template_part( 'admin/partials/setting-api', [ 'options' => $options ] ); ?>
                    </section>
                    <section id="banae-tab-support" class="banae-tab-content">
                        <?php $Helper::get_banae_template_part( 'admin/partials/support-section', [ 'options' => $options ] ); ?>
                    </section>
                </div>

            </div>
        </div>
    </form>
</div>