<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div id="banana-template-modal" style="display:none;">
    <div class="modal__overlay">
        <div class="banana-modal-container">
            <header class="modal__header">
                <div class="modal__branding">
                    <div class="icon-holder">
                        <i class="icofont-banana"></i>
                    </div>
                    <h3 class="modal__title">Add Template</h2>
                </div>
                <button class="modal__close" id="banana-close-modal" type="button"></button>
            </header>

            <div class="modal__content">

                <div class="modal__information">
                    <div class="info-title">BananaAddons Theme Builder helps you work smarter.</div>
                    <div class="info-message">Design reusable site sections (e.g: headers, footers, etc) for your site
                        and
                        later reuse them when needed.</div>
                    <div id="banae-circle-small"></div>
                    <div id="banae-circle-medium"></div>
                    <div id="banae-circle-large"></div>
                </div>

                <div class="banae-field-options">
                    <div>
                        <input type="text" id="banana-template-title" style="width:100%;"
                            placeholder="Enter your template name">
                    </div>

                    <div>
                        <select id="banana-template-type" style="width:100%;">
                            <option value="">Select Type</option>
                            <option value="header">Header</option>
                            <option value="footer">Footer</option>
                            <option value="single">Single</option>
                            <option value="archive">Archive</option>
                        </select>
                    </div>

                    <div>
                        <select id="banana-template-condition" style="width:100%;">
                            <option value="">Select Condition</option>
                            <option value="entire_site">Entire Site</option>
                            <option value="singular">Singular</option>
                            <option value="archive">Archive</option>
                        </select>
                    </div>

                    <div>
                        <button class="banana-btn-save" id="banana-save-template" type="button" disabled>
                            <div class="banae-btn-loading"></div> Save Template
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>