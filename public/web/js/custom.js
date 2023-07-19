// password hide and show

$(function () {
    $("#eye").click(function () {
        if ($(this).hasClass("fa-eye-slash")) {
            $(this).removeClass("fa-eye-slash");

            $(this).addClass("fa-eye");

            $("#password").attr("type", "text");
        } else {
            $(this).removeClass("fa-eye");

            $(this).addClass("fa-eye-slash");

            $("#password").attr("type", "password");
        }
    });
});

$(function () {
    $("#eyes").click(function () {
        if ($(this).hasClass("fa-eye-slash")) {
            $(this).removeClass("fa-eye-slash");

            $(this).addClass("fa-eye");

            $("#confirmPassword").attr("type", "text");
        } else {
            $(this).removeClass("fa-eye");

            $(this).addClass("fa-eye-slash");

            $("#confirmPassword").attr("type", "password");
        }
    });
});

// password hide and show

$(".slct-inst").click(function () {
    $(".institution-body").css("display", "block");
    $(".institution-bg").fadeIn();
    $("body").css("overflow", "hidden");
});

$(".institution-bg").click(function () {
    // $(".institution-bg").fadeOut();
    // $(".institution-body").fadeOut();
    $("body").css("overflow", "auto");
    return false;
});

// $('.go-next').click(function () {
//   $('.courses-body').css('display', 'block');
//   $('.institution-body').fadeOut();
//   $('.courses-bg').fadeIn();
//   $('body').css('overflow', 'hidden');

// });

$(".courses-bg").click(function () {
    $(".institution-bg").fadeOut();
    // $(".courses-bg").fadeOut();
    // $(".courses-body").fadeOut();
    // $(".institution-body").fadeOut();
    $("body").css("overflow", "auto");
    return false;
});

// Create Acc Popup

$(".slct-inst").click(function () {
    $(".select-institute").fadeIn();
});

$(".go-next").click(function () {
    $(".slct-cource").fadeIn();
    $(".select-institute").fadeOut();
});

// $(".join-course").click(function () {
//     window.open("sub-group.html", "name");
// });

$(".zoom-link").click(function () {
    $(".zoom-popup").fadeIn();
});

$(".cancel-meeting").click(function () {
    $(".zoom-popup").fadeOut();
});

$(".leave-meeting").click(function () {
    $(".leave-group ").fadeIn();
    $("html").css("overflow", "hidden");
});

$(".leave-meeting").click(function () {
    $(".leave-group ").fadeIn();
    $("html").css("overflow", "auto");
});

$(".continue-meeting").click(function () {
    $(".leave-group ").fadeOut();
});

$(".sign_out").click(function () {
    $(".log_out").fadeIn();
});

$(".edit_profile").click(function () {
    $(".update_profile").fadeIn();
    $("html").css("overflow", "hidden");
});

$(".feedback-icon").click(function () {
    $(".feeback").fadeIn();
    $("html").css("overflow", "hidden");
});

$(".remove-edit").click(function () {
    $(".update_profile").fadeOut();
});

$(".cancel-btn").click(function () {
    $(".update_profile").fadeOut();
});

$(".project-select").click(function () {
    $(".project-select").removeClass("active");
    $(this).addClass("active");
});

//  Direct chat

$(".direct-chat").click(function () {
    $(".profile-chat").fadeIn();
});

// ----------------------------

// Add Multiple Tags

Vue.component("tags-input", {
    props: ["value"],
    data() {
        return {
            newTag: "",
        };
    },
    methods: {
        addTag() {
            if (
                this.newTag.trim().length === 0 ||
                this.value.includes(this.newTag.trim())
            ) {
                return;
            }
            this.$emit("input", [...this.value, this.newTag.trim()]);
            this.newTag = "";
        },
        removeTag(tag) {
            this.$emit(
                "input",
                this.value.filter((t) => t !== tag)
            );
        },
    },
    render() {
        return this.$scopedSlots.default({
            tags: this.value,
            addTag: this.addTag,
            removeTag: this.removeTag,
            inputAttrs: { value: this.newTag },
            inputEvents: {
                input: (e) => {
                    this.newTag = e.target.value;
                },
                keydown: (e) => {
                    if (e.keyCode === 13) {
                        e.preventDefault();
                        this.addTag();
                    }
                },
            },
        });
    },
});

new Vue({
    el: "#app",
    data: {
        tags: [],
    },
});

// --------------------------------

// Tag Input

// $(document).ready(function () {
//   $(".tags-input").click(function () {
//     $(".add-tags-cover").fadeIn("slow");
//   });
// });

$("#create-new-tag").click(function () {
    $(".add-tags-cover").fadeIn("slow");
});

// ------------------------------

// responsive-media

$(".btn-right-menu").click(function () {
    $(".left-sidebar-body").slideToggle("slow");
    $(".sub-group .col-md-3").css({ height: "auto" });
    $(".sub-group .left-sidebar").css({ height: "auto" });
});

$(".btn-left-menu").click(function () {
    $(".right-sidebar-body").slideToggle("slow");
    $(".sub-group .col-md-3").css({ height: "auto" });
    $(".sub-group .left-sidebar").css({ height: "auto" });
});

// ------------------------------------------------

// User Profile

// $('.project-management').click(function () {
//   $('.all-users').hide();
//   $('.selected-user-profile').show();
//   $('.all-user-list').show();
// })

$(".all-user-list").click(function () {
    $(".all-users").show();
    $(".selected-user-profile").hide();
});

// ----------------------------------------------------

// ------------------------------------------------------------

// --------
$(document).ready(function () {
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(".profile-pic").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    };

    $(".file-upload").on("change", function () {
        readURL(this);
    });

    $(".upload-button").on("click", function () {
        $(".file-upload").click();
    });
});

// ---------------------

var masking = {
    // User defined Values
    //maskedInputs : document.getElementsByClassName('masked'), // add with IE 8's death
    maskedInputs: document.querySelectorAll(".masked"), // kill with IE 8's death
    maskedNumber: "XdDmMyY9",
    maskedLetter: "_",

    init: function () {
        masking.setUpMasks(masking.maskedInputs);
        masking.maskedInputs = document.querySelectorAll(".masked"); // Repopulating. Needed b/c static node list was created above.
        masking.activateMasking(masking.maskedInputs);
    },

    setUpMasks: function (inputs) {
        var i,
            l = inputs.length;

        for (i = 0; i < l; i++) {
            masking.createShell(inputs[i]);
        }
    },

    // replaces each masked input with a shall containing the input and it's mask.
    createShell: function (input) {
        var text = "",
            placeholder = input.getAttribute("placeholder");

        input.setAttribute("maxlength", placeholder.length);
        input.setAttribute("data-placeholder", placeholder);
        // input.removeAttribute('placeholder');
    },

    setValueOfMask: function (e) {
        var value = e.target.value,
            placeholder = e.target.getAttribute("data-placeholder");

        return "<i>" + value + "</i>" + placeholder.substr(value.length);
    },

    // add event listeners
    activateMasking: function (inputs) {
        var i, l;

        for (i = 0, l = inputs.length; i < l; i++) {
            if (masking.maskedInputs[i].addEventListener) {
                // remove "if" after death of IE 8
                masking.maskedInputs[i].addEventListener(
                    "keyup",
                    function (e) {
                        masking.handleValueChange(e);
                    },
                    false
                );
            } else if (masking.maskedInputs[i].attachEvent) {
                // For IE 8
                masking.maskedInputs[i].attachEvent("onkeyup", function (e) {
                    e.target = e.srcElement;
                    masking.handleValueChange(e);
                });
            }
        }
    },

    handleValueChange: function (e) {
        var id = e.target.getAttribute("id");

        switch (
            e.keyCode // allows navigating thru input
        ) {
            case 20: // caplocks
            case 17: // control
            case 18: // option
            case 16: // shift
            case 37: // arrow keys
            case 38:
            case 39:
            case 40:
            case 9: // tab (let blur handle tab)
                return;
        }

        document.getElementById(id).value = masking.handleCurrentValue(e);
        document.getElementById(id + "Mask").innerHTML =
            masking.setValueOfMask(e);
    },

    handleCurrentValue: function (e) {
        var isCharsetPresent = e.target.getAttribute("data-charset"),
            placeholder =
                isCharsetPresent || e.target.getAttribute("data-placeholder"),
            value = e.target.value,
            l = placeholder.length,
            newValue = "",
            i,
            j,
            isInt,
            isLetter,
            strippedValue;

        // strip special characters
        strippedValue = isCharsetPresent
            ? value.replace(/\W/g, "")
            : value.replace(/\D/g, "");

        for (i = 0, j = 0; i < l; i++) {
            var x = (isInt = !isNaN(parseInt(strippedValue[j])));
            isLetter = strippedValue[j]
                ? strippedValue[j].match(/[A-Z]/i)
                : false;
            matchesNumber = masking.maskedNumber.indexOf(placeholder[i]) >= 0;
            matchesLetter = masking.maskedLetter.indexOf(placeholder[i]) >= 0;

            if (
                (matchesNumber && isInt) ||
                (isCharsetPresent && matchesLetter && isLetter)
            ) {
                newValue += strippedValue[j++];
            } else if (
                (!isCharsetPresent && !isInt && matchesNumber) ||
                (isCharsetPresent &&
                    ((matchesLetter && !isLetter) || (matchesNumber && !isInt)))
            ) {
                // masking.errorOnKeyEntry(); // write your own error handling function
                return newValue;
            } else {
                newValue += placeholder[i];
            }
            // break if no characters left and the pattern is non-special character
            if (strippedValue[j] == undefined) {
                break;
            }
        }
        if (e.target.getAttribute("data-valid-example")) {
            return masking.validateProgress(e, newValue);
        }
        return newValue;
    },

    validateProgress: function (e, value) {
        var validExample = e.target.getAttribute("data-valid-example"),
            pattern = new RegExp(e.target.getAttribute("pattern")),
            placeholder = e.target.getAttribute("data-placeholder"),
            l = value.length,
            testValue = "";

        //convert to months
        if (l == 1 && placeholder.toUpperCase().substr(0, 2) == "MM") {
            if (value > 1 && value < 10) {
                value = "0" + value;
            }
            return value;
        }
        // test the value, removing the last character, until what you have is a submatch
        for (i = l; i >= 0; i--) {
            testValue = value + validExample.substr(value.length);
            if (pattern.test(testValue)) {
                return value;
            } else {
                value = value.substr(0, value.length - 1);
            }
        }

        return value;
    },

    errorOnKeyEntry: function () {
        // Write your own error handling
    },
};
masking.init();

$(".share-icon").click(function () {
    $(".share-file-info").fadeIn();
});

$(document).on("click", function (e) {
    if (
        !(
            $(e.target).closest(".share-file-info").length > 0 ||
            $(e.target).closest(".share-icon").length > 0
        )
    ) {
        $(".share-file-info").hide();
    }

    // if (!($(e.target).closest("#emoji-picker").length > 0 || $(e.target).closest(".smiley-emoji").length > 0)) {
    //     $("#emoji-picker").hide();
    // }
});

$(document).on("click", function (e) {
    if (
        !(
            $(e.target).closest(".emoji-picker").length > 0 ||
            $(e.target).closest(".smiley-emoji").length > 0
        )
    ) {
        $(".emoji-picker").hide();
    }
});

function refreshPage() {
    location.reload();
}
