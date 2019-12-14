/**
 * LangText Control
 * @author Seth Phat <phattranminh96@gmail.com>
 * @param {string} containerSelector Container Block String (#block_here)
 * @param {Object} options Config data for the LangTextControl
 * @param {Object} options.languages Language list
 * @param {String} options.default_language First Control will show
 * @param {Object} options.data Data for each of language control (default data after initialized)
 * @constructor
 */
function LangTextControl(containerSelector, options) {
    this.container = $(containerSelector);
    this.isRendered = false;
    this.canSetAll = true;

    // validations
    if (!this.container.length) {
        throw new TypeError("Container is not exists to handle.");
    }
    if (options && !_.isObject(options)) {
        throw new TypeError("Option data must be object");
    }
    if (_.isEmpty(options.languages)) {
        throw new TypeError("Option - Languages must be provided in order to create the control");
    }

    // base init
    this._baseRender();

    // create control now - first control (visible to all)
    let first_control = options.default_language || Object.keys(options.languages)[0] || "en";
    this.container.append(
        render(this._getTemplateControl(), {
            lang_code: options.default_language,
            lang_name: options.languages[options.default_language]
        })
    );
    delete options.languages[first_control];


    // Render all left
    let all_left_html = "<div class='left-control hidden'>";
    _.each(options.languages, function (lang_name, lang_code) {
        all_left_html += render(this._getTemplateControl(), {
            lang_code,
            lang_name
        });

    }.bind(this));
    this.container.append(all_left_html + "</div>");

    // flagged it
    this.isRendered = true;

    // set default data on init??
    if (options.data) {
        this.setValues(options.data);
    }

    // Register event
    var is_show = false;

    // Toggle Handler
    this.container.on('click', '.toggle', function (e) {
        this.container.find(".left-control").toggle("slow");
        is_show = !is_show;

        if (is_show) {
            this.container.find(".on-show").hide();
            this.container.find(".on-hide").show();
        } else {
            this.container.find(".on-show").show();
            this.container.find(".on-hide").hide();
        }
    }.bind(this));

    // First Set All handler
    this.container.on('change', '.lang-text-field:first', function (e) {
        let totalInputedField = $(".lang-text-field:not(:first)").filter(function () {
            return !!this.value;
        }).length;

        // check if possible to input value
        if (!this.canSetAll || totalInputedField > 0) {
            this.canSetAll = false;
            return;
        }

        let firstValue = e.target.value;
        this.container.find(".lang-text-field:not(:first)").val(firstValue);
        this.canSetAll = false;
    }.bind(this));
}

/**
 * Get LangText Values - Object Types
 * @return {Object} {en: "", vi: "", ...}
 */
LangTextControl.prototype.getValues = function () {
    let values = {};

    // traverse
    this.container.find(".lang-text-field").each(function () {
        let $control = $(this);

        // get control value
        values[$control.attr('data-lang')] = $control.val();
    });

    return values;
};

/**
 * Set Values into The Controls
 * @param {Object} values {lang_code: value}
 * @param {String} values.en Value for English
 * @param {String} values.de Value for German
 * @param {String} values.vi Value for Vietnamese
 * ...
 * And so on...
 */
LangTextControl.prototype.setValues = function (values) {
    this.canSetAll = false;

    _.each(values, function (value, lang_code) {
        let $control = this.container.find(`.lang-text-field[data-lang='${lang_code}']`);
        if (!$control) {
            return
        }

        $control.val(value);
    }.bind(this));
};

/**
 * Init function, render necessary item
 * @private
 */
LangTextControl.prototype._baseRender = function() {
    if (this.isRendered) {
        return;
    }

    this.container.addClass('lang-text-control-container');
    this.container.append(`
        <div class="toggle">
            <a href="javascript:void(0);" class="on-show">
                <i class="fa fa-eye"></i>
            </a>
            <a href="javascript:void(0);" class="on-hide hidden">
                <i class="fa fa-eye-slash"></i>
            </a>
        </div>
    `);
};

/**
 * Get Template String for Control
 * @private
 */
LangTextControl.prototype._getTemplateControl = function () {
    return `
        <div class="form-group">
            <label>{{lang_name}}</label>
            <textarea class="form-control lang-text-field" name="lang_text[{{lang_code}}]" data-lang="{{lang_code}}" rows="6"></textarea>
        </div>
    `;
};