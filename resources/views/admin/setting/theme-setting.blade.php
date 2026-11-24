<div class="tab-pane fade" id="theme-setting" role="tabpanel" aria-labelledby="list-theme-list">
    <div class="card border">
        <div class="card-header">
            <h4>Theme & Appearance Settings</h4>
        </div>
        <div class="card-body">
            <!-- Preset Palettes -->
            <div class="mb-4 p-3 bg-light rounded border">
                <label class="font-weight-bold text-dark d-block mb-2">
                    <i class="fas fa-palette mr-1 text-primary"></i> Quick Color Presets (1-Click Apply)
                </label>
                <small class="text-muted d-block mb-3">Choose a pre-configured harmonious palette or customize individual colors below.</small>
                <div class="d-flex flex-wrap gap-2" style="gap: 8px;">
                    <button type="button" class="btn btn-sm btn-outline-primary theme-preset-btn"
                        data-theme="#0088cc" data-header-bg="#0088cc" data-header-text="#ffffff"
                        data-footer-bg="#0b2c3d" data-footer-bottom="#0088cc" data-footer-text="#ffffff"
                        data-btn-bg="#0088cc" data-btn-text="#ffffff" data-btn-hover="#02527a">
                        <span class="d-inline-block rounded-circle mr-1" style="width:12px; height:12px; background:#0088cc; vertical-align:middle;"></span> Default Blue
                    </button>

                    <button type="button" class="btn btn-sm btn-outline-success theme-preset-btn"
                        data-theme="#10b981" data-header-bg="#064e3b" data-header-text="#ffffff"
                        data-footer-bg="#022c22" data-footer-bottom="#10b981" data-footer-text="#ffffff"
                        data-btn-bg="#10b981" data-btn-text="#ffffff" data-btn-hover="#059669">
                        <span class="d-inline-block rounded-circle mr-1" style="width:12px; height:12px; background:#10b981; vertical-align:middle;"></span> Emerald Green
                    </button>

                    <button type="button" class="btn btn-sm btn-outline-info theme-preset-btn"
                        data-theme="#0d9488" data-header-bg="#134e4a" data-header-text="#ffffff"
                        data-footer-bg="#042f2e" data-footer-bottom="#0d9488" data-footer-text="#ffffff"
                        data-btn-bg="#0d9488" data-btn-text="#ffffff" data-btn-hover="#0f766e">
                        <span class="d-inline-block rounded-circle mr-1" style="width:12px; height:12px; background:#0d9488; vertical-align:middle;"></span> Modern Teal
                    </button>

                    <button type="button" class="btn btn-sm btn-outline-danger theme-preset-btn"
                        data-theme="#e11d48" data-header-bg="#881337" data-header-text="#ffffff"
                        data-footer-bg="#1c0710" data-footer-bottom="#e11d48" data-footer-text="#ffffff"
                        data-btn-bg="#e11d48" data-btn-text="#ffffff" data-btn-hover="#be123c">
                        <span class="d-inline-block rounded-circle mr-1" style="width:12px; height:12px; background:#e11d48; vertical-align:middle;"></span> Crimson Red
                    </button>

                    <button type="button" class="btn btn-sm btn-outline-warning theme-preset-btn"
                        data-theme="#ea580c" data-header-bg="#9a3412" data-header-text="#ffffff"
                        data-footer-bg="#1c1917" data-footer-bottom="#ea580c" data-footer-text="#ffffff"
                        data-btn-bg="#ea580c" data-btn-text="#ffffff" data-btn-hover="#c2410c">
                        <span class="d-inline-block rounded-circle mr-1" style="width:12px; height:12px; background:#ea580c; vertical-align:middle;"></span> Sunset Orange
                    </button>

                    <button type="button" class="btn btn-sm btn-outline-secondary theme-preset-btn"
                        data-theme="#7c3aed" data-header-bg="#4c1d95" data-header-text="#ffffff"
                        data-footer-bg="#2e1065" data-footer-bottom="#7c3aed" data-footer-text="#ffffff"
                        data-btn-bg="#7c3aed" data-btn-text="#ffffff" data-btn-hover="#6d28d9">
                        <span class="d-inline-block rounded-circle mr-1" style="width:12px; height:12px; background:#7c3aed; vertical-align:middle;"></span> Royal Purple
                    </button>

                    <button type="button" class="btn btn-sm btn-outline-dark theme-preset-btn"
                        data-theme="#2563eb" data-header-bg="#111827" data-header-text="#ffffff"
                        data-footer-bg="#030712" data-footer-bottom="#1f2937" data-footer-text="#ffffff"
                        data-btn-bg="#2563eb" data-btn-text="#ffffff" data-btn-hover="#1d4ed8">
                        <span class="d-inline-block rounded-circle mr-1" style="width:12px; height:12px; background:#111827; vertical-align:middle;"></span> Dark Midnight
                    </button>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.theme-setting-update') }}" method="POST" id="themeSettingForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left: Color Controls -->
                    <div class="col-lg-7">
                        <!-- Section: Brand & Theme -->
                        <h6 class="text-primary font-weight-bold mb-3">
                            <i class="fas fa-brush mr-1"></i> 1. Site Theme & Accent
                        </h6>

                        <div class="form-group mb-3">
                            <label class="font-weight-600">Site Theme / Primary Accent Color</label>
                            <small class="text-muted d-block mb-1">Controls brand highlights, badges, active tabs, menu hover, links, category bar, and scroll button.</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <input type="color" class="form-control color-picker-input" style="width: 50px; padding: 2px; cursor: pointer; height: calc(2.25rem + 2px);"
                                        data-target="#theme_color" value="{{ @$generalSettings->theme_color ?? '#0088cc' }}">
                                </div>
                                <input type="text" class="form-control hex-input" name="theme_color" id="theme_color"
                                    value="{{ @$generalSettings->theme_color ?? '#0088cc' }}" required>
                            </div>
                        </div>

                        <hr>

                        <!-- Section: Header Colors -->
                        <h6 class="text-primary font-weight-bold mb-3">
                            <i class="fas fa-window-maximize mr-1"></i> 2. Header Colors
                        </h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-600">Header Background Color</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="color" class="form-control color-picker-input" style="width: 50px; padding: 2px; cursor: pointer; height: calc(2.25rem + 2px);"
                                                data-target="#header_bg_color" value="{{ @$generalSettings->header_bg_color ?? '#0088cc' }}">
                                        </div>
                                        <input type="text" class="form-control hex-input" name="header_bg_color" id="header_bg_color"
                                            value="{{ @$generalSettings->header_bg_color ?? '#0088cc' }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-600">Header Text & Icon Color</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="color" class="form-control color-picker-input" style="width: 50px; padding: 2px; cursor: pointer; height: calc(2.25rem + 2px);"
                                                data-target="#header_text_color" value="{{ @$generalSettings->header_text_color ?? '#ffffff' }}">
                                        </div>
                                        <input type="text" class="form-control hex-input" name="header_text_color" id="header_text_color"
                                            value="{{ @$generalSettings->header_text_color ?? '#ffffff' }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Section: Footer Colors -->
                        <h6 class="text-primary font-weight-bold mb-3">
                            <i class="fas fa-shoe-prints mr-1"></i> 3. Footer Colors
                        </h6>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-600">Footer Background</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="color" class="form-control color-picker-input" style="width: 50px; padding: 2px; cursor: pointer; height: calc(2.25rem + 2px);"
                                                data-target="#footer_bg_color" value="{{ @$generalSettings->footer_bg_color ?? '#0b2c3d' }}">
                                        </div>
                                        <input type="text" class="form-control hex-input" name="footer_bg_color" id="footer_bg_color"
                                            value="{{ @$generalSettings->footer_bg_color ?? '#0b2c3d' }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-600">Footer Text Color</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="color" class="form-control color-picker-input" style="width: 50px; padding: 2px; cursor: pointer; height: calc(2.25rem + 2px);"
                                                data-target="#footer_text_color" value="{{ @$generalSettings->footer_text_color ?? '#ffffff' }}">
                                        </div>
                                        <input type="text" class="form-control hex-input" name="footer_text_color" id="footer_text_color"
                                            value="{{ @$generalSettings->footer_text_color ?? '#ffffff' }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-600">Footer Bottom Bar</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="color" class="form-control color-picker-input" style="width: 50px; padding: 2px; cursor: pointer; height: calc(2.25rem + 2px);"
                                                data-target="#footer_bottom_color" value="{{ @$generalSettings->footer_bottom_color ?? '#0088cc' }}">
                                        </div>
                                        <input type="text" class="form-control hex-input" name="footer_bottom_color" id="footer_bottom_color"
                                            value="{{ @$generalSettings->footer_bottom_color ?? '#0088cc' }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Section: Button Colors -->
                        <h6 class="text-primary font-weight-bold mb-3">
                            <i class="fas fa-hand-pointer mr-1"></i> 4. Button Colors
                        </h6>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-600">Button Background</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="color" class="form-control color-picker-input" style="width: 50px; padding: 2px; cursor: pointer; height: calc(2.25rem + 2px);"
                                                data-target="#button_color" value="{{ @$generalSettings->button_color ?? '#0088cc' }}">
                                        </div>
                                        <input type="text" class="form-control hex-input" name="button_color" id="button_color"
                                            value="{{ @$generalSettings->button_color ?? '#0088cc' }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-600">Button Text Color</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="color" class="form-control color-picker-input" style="width: 50px; padding: 2px; cursor: pointer; height: calc(2.25rem + 2px);"
                                                data-target="#button_text_color" value="{{ @$generalSettings->button_text_color ?? '#ffffff' }}">
                                        </div>
                                        <input type="text" class="form-control hex-input" name="button_text_color" id="button_text_color"
                                            value="{{ @$generalSettings->button_text_color ?? '#ffffff' }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="font-weight-600">Button Hover Color</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="color" class="form-control color-picker-input" style="width: 50px; padding: 2px; cursor: pointer; height: calc(2.25rem + 2px);"
                                                data-target="#button_hover_color" value="{{ @$generalSettings->button_hover_color ?? '#02527a' }}">
                                        </div>
                                        <input type="text" class="form-control hex-input" name="button_hover_color" id="button_hover_color"
                                            value="{{ @$generalSettings->button_hover_color ?? '#02527a' }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right: Live Preview Box -->
                    <div class="col-lg-5">
                        <div class="sticky-top" style="top: 20px; z-index: 10;">
                            <label class="font-weight-bold text-dark d-block mb-2">
                                <i class="fas fa-eye mr-1 text-primary"></i> Live Theme Preview
                            </label>
                            <small class="text-muted d-block mb-3">Real-time simulation of how frontend components will look.</small>

                            <div class="border rounded shadow-sm overflow-hidden" id="livePreviewContainer" style="background: #f8f9fa;">
                                <!-- Preview Header -->
                                <div id="previewHeader" class="p-3 d-flex justify-content-between align-items-center" style="background: {{ @$generalSettings->header_bg_color ?? '#0088cc' }}; color: {{ @$generalSettings->header_text_color ?? '#ffffff' }}; transition: all 0.3s;">
                                    <div class="font-weight-bold" style="font-size: 15px;">
                                        <i class="fas fa-shopping-bag mr-1"></i> {{ @$generalSettings->site_name ?? 'Shop Demo' }}
                                    </div>
                                    <div class="d-flex align-items-center" style="gap: 15px;">
                                        <span style="font-size: 12px;"><i class="fas fa-phone-alt mr-1"></i> Support</span>
                                        <span class="position-relative">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span id="previewCartBadge" class="badge rounded-pill" style="font-size: 9px; position: absolute; top: -8px; right: -8px; background: {{ @$generalSettings->theme_color ?? '#0088cc' }}; color: #fff;">3</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Preview Menu Bar -->
                                <div id="previewMenuBar" class="bg-white px-3 py-2 border-bottom d-flex align-items-center justify-content-between" style="font-size: 13px;">
                                    <div class="d-flex align-items-center" style="gap: 10px;">
                                        <span id="previewCatBar" class="px-2 py-1 text-white rounded" style="background: {{ @$generalSettings->theme_color ?? '#0088cc' }}; font-size: 11px;">
                                            <i class="fas fa-bars mr-1"></i> Categories
                                        </span>
                                        <span id="previewActiveNav" class="font-weight-bold" style="color: {{ @$generalSettings->theme_color ?? '#0088cc' }};">Home</span>
                                        <span class="text-muted">Shop</span>
                                        <span class="text-muted">Flash Sale</span>
                                    </div>
                                    <span id="previewScrollBtn" class="text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 22px; height: 22px; background: {{ @$generalSettings->theme_color ?? '#0088cc' }}; font-size: 10px;">
                                        <i class="fas fa-arrow-up"></i>
                                    </span>
                                </div>

                                <!-- Preview Content & Buttons -->
                                <div class="p-3 bg-white">
                                    <div class="border rounded p-2 mb-2 d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="font-weight-600" style="font-size: 13px;">Sample Product Item</div>
                                            <small id="previewThemePrice" style="color: {{ @$generalSettings->theme_color ?? '#0088cc' }}; font-weight: 700;">$99.00</small>
                                        </div>
                                        <button type="button" id="previewBtn" class="btn btn-sm" style="background: {{ @$generalSettings->button_color ?? '#0088cc' }}; color: {{ @$generalSettings->button_text_color ?? '#ffffff' }}; font-size: 12px; border-radius: 20px; padding: 4px 14px; border: none;">
                                            <i class="fas fa-cart-plus mr-1"></i> Add To Cart
                                        </button>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span id="previewBadge" class="badge" style="background: {{ @$generalSettings->theme_color ?? '#0088cc' }}; color: #fff; font-size: 11px;">
                                            25% OFF
                                        </span>
                                        <button type="button" id="previewOutlineBtn" class="btn btn-sm btn-outline-secondary" style="font-size: 11px; border-color: {{ @$generalSettings->theme_color ?? '#0088cc' }}; color: {{ @$generalSettings->theme_color ?? '#0088cc' }};">
                                            View Details <i class="fas fa-chevron-right ml-1"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Preview Footer -->
                                <div id="previewFooter" class="p-3" style="background: {{ @$generalSettings->footer_bg_color ?? '#0b2c3d' }}; color: {{ @$generalSettings->footer_text_color ?? '#ffffff' }}; font-size: 12px; transition: all 0.3s;">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="font-weight-bold mb-1" style="font-size: 13px;">About Our Store</div>
                                            <small style="opacity: 0.85;">Premium eCommerce destination with fast delivery and top quality.</small>
                                        </div>
                                        <div class="col-5">
                                            <div class="font-weight-bold mb-1" style="font-size: 13px;">Quick Links</div>
                                            <div style="opacity: 0.85; font-size: 11px;">&bull; Privacy Policy</div>
                                            <div style="opacity: 0.85; font-size: 11px;">&bull; Terms & Conditions</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview Footer Bottom -->
                                <div id="previewFooterBottom" class="px-3 py-2 text-center" style="background: {{ @$generalSettings->footer_bottom_color ?? '#0088cc' }}; color: {{ @$generalSettings->footer_text_color ?? '#ffffff' }}; font-size: 11px; transition: all 0.3s;">
                                    <span>&copy; {{ date('Y') }} All Rights Reserved.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save mr-1"></i> Save Theme Settings
                        </button>
                        <button type="button" id="resetThemeDefaultsBtn" class="btn btn-outline-secondary ml-2">
                            <i class="fas fa-undo mr-1"></i> Reset Defaults
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputs = {
        theme_color: document.getElementById('theme_color'),
        header_bg_color: document.getElementById('header_bg_color'),
        header_text_color: document.getElementById('header_text_color'),
        footer_bg_color: document.getElementById('footer_bg_color'),
        footer_text_color: document.getElementById('footer_text_color'),
        footer_bottom_color: document.getElementById('footer_bottom_color'),
        button_color: document.getElementById('button_color'),
        button_text_color: document.getElementById('button_text_color'),
        button_hover_color: document.getElementById('button_hover_color'),
    };

    // Color pickers sync
    document.querySelectorAll('.color-picker-input').forEach(picker => {
        picker.addEventListener('input', function() {
            const targetInput = document.querySelector(this.getAttribute('data-target'));
            if (targetInput) {
                targetInput.value = this.value;
                updateLivePreview();
            }
        });
    });

    // Hex text inputs sync
    document.querySelectorAll('.hex-input').forEach(input => {
        input.addEventListener('input', function() {
            const picker = document.querySelector(`.color-picker-input[data-target="#${this.id}"]`);
            if (picker && /^#[0-9A-Fa-f]{6}$/i.test(this.value.trim())) {
                picker.value = this.value.trim();
            }
            updateLivePreview();
        });
    });

    // Update Live Preview elements
    function updateLivePreview() {
        const theme = inputs.theme_color ? inputs.theme_color.value : '#0088cc';
        const headerBg = inputs.header_bg_color ? inputs.header_bg_color.value : '#0088cc';
        const headerText = inputs.header_text_color ? inputs.header_text_color.value : '#ffffff';
        const footerBg = inputs.footer_bg_color ? inputs.footer_bg_color.value : '#0b2c3d';
        const footerText = inputs.footer_text_color ? inputs.footer_text_color.value : '#ffffff';
        const footerBottom = inputs.footer_bottom_color ? inputs.footer_bottom_color.value : '#0088cc';
        const btnBg = inputs.button_color ? inputs.button_color.value : '#0088cc';
        const btnText = inputs.button_text_color ? inputs.button_text_color.value : '#ffffff';

        // Header
        const pHeader = document.getElementById('previewHeader');
        if (pHeader) {
            pHeader.style.background = headerBg;
            pHeader.style.color = headerText;
        }

        // Theme elements
        const pCatBar = document.getElementById('previewCatBar');
        if (pCatBar) pCatBar.style.background = theme;

        const pActiveNav = document.getElementById('previewActiveNav');
        if (pActiveNav) pActiveNav.style.color = theme;

        const pScrollBtn = document.getElementById('previewScrollBtn');
        if (pScrollBtn) pScrollBtn.style.background = theme;

        const pThemePrice = document.getElementById('previewThemePrice');
        if (pThemePrice) pThemePrice.style.color = theme;

        const pBadge = document.getElementById('previewBadge');
        if (pBadge) pBadge.style.background = theme;

        const pCartBadge = document.getElementById('previewCartBadge');
        if (pCartBadge) pCartBadge.style.background = theme;

        const pOutlineBtn = document.getElementById('previewOutlineBtn');
        if (pOutlineBtn) {
            pOutlineBtn.style.borderColor = theme;
            pOutlineBtn.style.color = theme;
        }

        // Button
        const pBtn = document.getElementById('previewBtn');
        if (pBtn) {
            pBtn.style.background = btnBg;
            pBtn.style.color = btnText;
        }

        // Footer
        const pFooter = document.getElementById('previewFooter');
        if (pFooter) {
            pFooter.style.background = footerBg;
            pFooter.style.color = footerText;
        }

        const pFooterBottom = document.getElementById('previewFooterBottom');
        if (pFooterBottom) {
            pFooterBottom.style.background = footerBottom;
            pFooterBottom.style.color = footerText;
        }
    }

    // Apply color values helper
    function applyColorValues(values) {
        Object.keys(values).forEach(key => {
            if (inputs[key]) {
                inputs[key].value = values[key];
                const picker = document.querySelector(`.color-picker-input[data-target="#${key}"]`);
                if (picker) picker.value = values[key];
            }
        });
        updateLivePreview();
    }

    // Presets
    document.querySelectorAll('.theme-preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            applyColorValues({
                theme_color: this.getAttribute('data-theme'),
                header_bg_color: this.getAttribute('data-header-bg'),
                header_text_color: this.getAttribute('data-header-text'),
                footer_bg_color: this.getAttribute('data-footer-bg'),
                footer_bottom_color: this.getAttribute('data-footer-bottom'),
                footer_text_color: this.getAttribute('data-footer-text'),
                button_color: this.getAttribute('data-btn-bg'),
                button_text_color: this.getAttribute('data-btn-text'),
                button_hover_color: this.getAttribute('data-btn-hover')
            });
        });
    });

    // Reset Defaults
    const resetBtn = document.getElementById('resetThemeDefaultsBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            applyColorValues({
                theme_color: '#0088cc',
                header_bg_color: '#0088cc',
                header_text_color: '#ffffff',
                footer_bg_color: '#0b2c3d',
                footer_text_color: '#ffffff',
                footer_bottom_color: '#0088cc',
                button_color: '#0088cc',
                button_text_color: '#ffffff',
                button_hover_color: '#02527a'
            });
        });
    }

    // Run once on load
    updateLivePreview();
});
</script>
