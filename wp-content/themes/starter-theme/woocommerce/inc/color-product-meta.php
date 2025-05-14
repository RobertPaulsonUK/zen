<?php
    add_action('pa_color_add_form_fields', function () {
        ?>
        <div class="form-field">
            <label for="option_css_value">
                <?= esc_html(__('Css value','robert-theme')) ?>
            </label>
            <input type="text" name="option_css_value" id="option_css_value" value="">
            <p class="description"><?= esc_html(__('Set Css value of option','robert-theme')) ?></p>
        </div>
        <?php
    });

    add_action('pa_color_edit_form_fields', function ($term) {
        $value = get_term_meta($term->term_id, 'option_css_value', true);
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="option_css_value">
                    <?= esc_html(__('Css value','robert-theme')) ?>
                </label>
            </th>
            <td>
                <input type="text" name="option_css_value" id="option_css_value" value="<?php echo esc_attr($value); ?>">
                <span style="display: inline-block;width: 40px;height: 40px;margin-top: 20px; background: <?php echo esc_attr($value); ?>;">
                </span>
                <p class="description"><?= esc_html(__('Update Css value of option','robert-theme')) ?></p>
            </td>
        </tr>
        <?php
    });

    add_action('created_pa_color', function ($term_id) {
        if (isset($_POST['option_css_value'])) {
            update_term_meta($term_id, 'option_css_value', sanitize_text_field($_POST['option_css_value']));
        }
    });

    add_action('edited_pa_color', function ($term_id) {
        if (isset($_POST['option_css_value'])) {
            update_term_meta($term_id, 'option_css_value', sanitize_text_field($_POST['option_css_value']));
        }
    });
