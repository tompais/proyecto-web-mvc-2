! function(A) {
    function e(e) {
        for (var B, C, I = e[0], Q = e[1], i = e[2], o = 0, a = []; o < I.length; o++) C = I[o], E[C] && a.push(E[C][0]), E[C] = 0;
        for (B in Q) Object.prototype.hasOwnProperty.call(Q, B) && (A[B] = Q[B]);
        for (n && n(e); a.length;) a.shift()();
        return t.push.apply(t, i || []), g()
    }

    function g() {
        for (var A, e = 0; e < t.length; e++) {
            for (var g = t[e], B = !0, I = 1; I < g.length; I++) {
                var Q = g[I];
                0 !== E[Q] && (B = !1)
            }
            B && (t.splice(e--, 1), A = C(C.s = g[0]))
        }
        return A
    }
    var B = {},
        E = {
            0: 0
        },
        t = [];

    function C(e) {
        if (B[e]) return B[e].exports;
        var g = B[e] = {
            i: e,
            l: !1,
            exports: {}
        };
        return A[e].call(g.exports, g, g.exports, C), g.l = !0, g.exports
    }
    C.m = A, C.c = B, C.d = function(A, e, g) {
        C.o(A, e) || Object.defineProperty(A, e, {
            enumerable: !0,
            get: g
        })
    }, C.r = function(A) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(A, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(A, "__esModule", {
            value: !0
        })
    }, C.t = function(A, e) {
        if (1 & e && (A = C(A)), 8 & e) return A;
        if (4 & e && "object" == typeof A && A && A.__esModule) return A;
        var g = Object.create(null);
        if (C.r(g), Object.defineProperty(g, "default", {
                enumerable: !0,
                value: A
            }), 2 & e && "string" != typeof A)
            for (var B in A) C.d(g, B, function(e) {
                return A[e]
            }.bind(null, B));
        return g
    }, C.n = function(A) {
        var e = A && A.__esModule ? function() {
            return A.default
        } : function() {
            return A
        };
        return C.d(e, "a", e), e
    }, C.o = function(A, e) {
        return Object.prototype.hasOwnProperty.call(A, e)
    }, C.p = "./";
    var I = window.webpackJsonp = window.webpackJsonp || [],
        Q = I.push.bind(I);
    I.push = e, I = I.slice();
    for (var i = 0; i < I.length; i++) e(I[i]);
    var n = Q;
    t.push([5, 1]), g()
}([, function(A, e, g) {}, , , , function(A, e, g) {
    A.exports = g(10)
}, function(A, e, g) {}, , function(A, e) {
    Element.prototype.matches || (Element.prototype.matches = Element.prototype.matchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector || Element.prototype.oMatchesSelector || Element.prototype.webkitMatchesSelector || function(A) {
            for (var e = (this.document || this.ownerDocument).querySelectorAll(A), g = e.length; --g >= 0 && e.item(g) !== this;);
            return g > -1
        }), Array.prototype.findIndex || Object.defineProperty(Array.prototype, "findIndex", {
            value: function(A) {
                if (null == this) throw new TypeError('"this" is null or not defined');
                var e = Object(this),
                    g = e.length >>> 0;
                if ("function" != typeof A) throw new TypeError("predicate must be a function");
                for (var B = arguments[1], E = 0; E < g;) {
                    var t = e[E];
                    if (A.call(B, t, E, e)) return E;
                    E++
                }
                return -1
            },
            configurable: !0,
            writable: !0
        }),
        function() {
            if ("function" == typeof window.CustomEvent) return !1;

            function A(A, e) {
                e = e || {
                    bubbles: !1,
                    cancelable: !1,
                    detail: null
                };
                var g = document.createEvent("CustomEvent");
                return g.initCustomEvent(A, e.bubbles, e.cancelable, e.detail), g
            }
            A.prototype = window.Event.prototype, window.CustomEvent = A
        }()
}, function(A, e, g) {
    A.exports = g.p + "8d34959997c6158d6a4d1c506f5ff73e.svg"
}, function(A, e, g) {
    "use strict";
    g.r(e);
    g(6);
    var B = g(0),
        E = g.n(B),
        t = g(2),
        C = g.n(t),
        I = g(3),
        Q = g.n(I),
        i = g(4),
        n = g.n(i),
        o = (g(1), g(8), function() {
            function A(e, g) {
                if (Q()(this, A), !e) throw new Error("No uploadId found. You must initialize file-upload-with-preview with a unique uploadId.");
                if (this.uploadId = e, this.options = g || {}, this.options.showDeleteButtonOnImages = !this.options.hasOwnProperty("showDeleteButtonOnImages") || this.options.showDeleteButtonOnImages, this.options.text = this.options.hasOwnProperty("text") ? this.options.text : {
                        chooseFile: "Ej: imagen.jpg "
                    }, this.options.text.chooseFile = this.options.text.hasOwnProperty("chooseFile") ? this.options.text.chooseFile : "Choose file...", this.options.text.browse = this.options.text.hasOwnProperty("browse") ? this.options.text.browse : "Seleccionar", this.options.text.selectedCount = this.options.text.hasOwnProperty("selectedCount") ? this.options.text.selectedCount : "files selected", this.cachedFileArray = [], this.currentFileCount = 0, this.el = document.querySelector('.custom-file-container[data-upload-id="'.concat(this.uploadId, '"]')), !this.el) throw new Error("Could not find a 'custom-file-container' with the id of: ".concat(this.uploadId));
                if (this.input = this.el.querySelector('input[type="file"]'), this.inputLabel = this.el.querySelector(".custom-file-container__custom-file__custom-file-control"), this.imagePreview = this.el.querySelector(".custom-file-container__image-preview"), this.clearButton = this.el.querySelector(".custom-file-container__image-clear"), this.inputLabel.innerHTML = this.options.text.chooseFile, this.addBrowseButton(this.options.text.browse), !(this.el && this.input && this.inputLabel && this.imagePreview && this.clearButton)) throw new Error("Cannot find all necessary elements. Please make sure you have all the necessary elements in your html for the id: ".concat(this.uploadId));
                this.options.images = this.options.hasOwnProperty("images") ? this.options.images : {}, this.baseImage = this.options.images.hasOwnProperty("baseImage") ? this.options.images.baseImage : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAiQAAAD6CAMAAACmhqw0AAAA+VBMVEUAAAD29u3u7unt7ent7enu7uju7uihoqCio6Gio6KjpKOkpaSmpqSmp6WoqKaqq6mqq6qrq6qsrautrauur62wsa6xsa+xsrCys7GztLK0tbK1trS2t7S3t7W4uba5ure6u7e7vLm8vbu9vrvAwL3Awb3DxMHFxcPGxsPHx8TIycXLzMjLzMnMzMnNzsrPz8vP0MzQ0M3S0s/U1NDV1dLX19TY2NTY2NXZ2dba2tXb29bc3Nfc3Njc3dnd3dre3tre39vg4Nvh4dzi4t3i4t7j497k5N/k5ODl5eDl5eHl5uLm5uHn5+Lo6OPp6eTq6uXr6+bs7Oft7eh54KxIAAAAB3RSTlMAHKbl5uztvql9swAABA1JREFUeNrt3VlT01AYgOG0oEEE910URNzFBVFcqCgKirLU/P8fI3QYbEOSdtrMyJzzvHfMlFx833NBQuY0SRrN8UwqabzZSJLGaYNQVacaSdMUVF0zGTMEVTeWmIH6BYkgESSCRJAIEkEiSCRIBIkgESSCRJAIEkEiQSJIBIkgESSCRJAIEgkSQSJIBIkgESSCRJBIkAgSQSJIBIkgESSCRIJEkAgSQSJIBIkgkSARJIJEkAgSQSJIBIkEiSARJIJEkAgSQSJIJEgEiSARJIJEkAgSQSJBIkgEiSARJIJEkAgSCRJBIkgEiSARJIJEgkSQ5PvxbdS+tyEJuZVb0+noTV579geSQGs/SOvqxiYkYfYwra+rbUhC7NNEjUjSJ5CE2P06jaTnIAmxKwe7vb468t3N14WOki1IAuzMwWrf1HCh3Q6S95AEWGe1b0/WlSCBBBJIIAkdSXvt1aNXa21IICld7dJU5+epJUggKV7tzuzRA4/ZHUggKVrtfNdjsXlIIClY7XLPw9NlSCA5vtqLPUguQgLJsdX+zv0fZhsSSPKrXckhWSn5jV8zG5DEiuR1DsnrEiOX0vMbkESKZDWHZLXMSFqsBJIIkOz1vn40sVdqpFgJJDHc3dzsQXKzwkihEkhiQLI+2f3y+3qVkSIlkMSAJFvsQrJYbaRACSRRIMlenj0UcPZlPyPHlUASB5Jsc+7cwevMc5v9jRxTAkkkSPbb+riVZYMYySuBJB4kJRUYySmBJHYkhUZ6lUASOZISIz1KIIkbSamRbiWQxIZkvT2YkS4lkESGpDV9tz2YkX9KIIkLSWs6TY+U9DFypASSqJC0OicfHSrpa2T/k5BEh6R1eDpWR8kARtIZSGJD0jo6QW1fySBGIIkOSavrlL27PwcxAklsSFo9JzFOppBAkl9ta5jTOiGJCslQRiCJCslwRiCJCcmQRiCJCMmwRiCJB8mXoU+YhyQaJM9TSCCBBBJIIIEEEkgggQQSSCCJAsnyzLA9hiQWJCfnSpBAAgkkkATXxFCnPxfU7iB5B0mAXT5Y7Z3t0Y087SDZgCTA7tX6bZ5TGSQBtlwrkgVIgmy+RiMXdiEJsp3b9Rn5nEESaC/O1/P3yMJuBkm4bX94O2rvNiKbWXRIBIkgESSCRJAIEkEiQSJIBIkgESSCRJAIEgkSQSJIBIkgESSCRIJEkAgSQSJIBIkgESQSJIJEkAgSQSJIBIkgkSARJIJEkAgSQSJIBIkEiSARJIJEkAgSQSJIJEgEiSARJIJEkAgSCRJBIkgEiSARJIJEkEiQCBJBIkgEiSARJIJEgkSQCBJBIkgEiSARJBIkgkSQ6P8gGTMDVTeWNA1B1TWTxmlTUFWnGknSaI4bhMoabzaSv+4BHFVoHZzfAAAAAElFTkSuQmCC", this.successPdfImage = this.options.images.hasOwnProperty("successPdfImage") ? this.options.images.successPdfImage : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAiQAAAD6CAMAAACmhqw0AAACClBMVEUAAAD29u3u7unt7ent7enu7uju7uhYowBbpARcpQZdpghjqBFlqRRqrB1trSBuriJwryVysCh6tDWAtz2CuEKGukeQv1aVwV+Yw2OZw2SaxGWaxGebxGmfxm6hoqCio6Gio6KjpKOkpaSkyXempqSmp6WnqKanynqoqKaoqaepqqiqq6iqq6mqq6qqzH6rq6qrrKutrautrqyur6yvr62wsa6xsa+xsrCysrCys7Cys7Gzs7GztLGztLK0tbK0tbO1tbO1trS2t7W3t7W3uLa30pO4uba5ube5ure6u7e7vLm8vLq8vbu81Zq81Zy9vru91Z6+vry+v7y/v72/wL2/1qDAwL3Awb3Awb7Bwr7Cwr/Cw7/Dw8DDxMDDxMHD2KXExMHExMLFxcPFxsPGxsPG2qvHx8THyMTIyMXIycXJycbJysbKysfKy8fK27DK3LHLy8fLy8jLzMnMzMnNzcnNzsrPz8vP0MzQ0M3R0c3R0s7S0s/U1NDU1dHW19PX4sXY2NTY2NXY2dXZ2dXZ2dba2tXa2tba29bb29bb5Mrb5Mvc3Nfc3Njc3djc3dnd3dne3tre39vf39vg4Nvg59Ph4dzh4d3i4t3i4t7i6Nbj497k5N/k5ODl5eDl5eHl5uLl6drm5uHn5+Ln5+Po6OPp6eTq6uXq6+Lq7OPr6+bs7OXs7Oft7eft7ejA9tVyAAAAB3RSTlMAHKbl5uztvql9swAABYdJREFUeNrt3Gl3E2UYgOEkLRRFEPc9hAqICAqo4AaioiguiOKGiqAoUHGjQhWLIIgiiCjIItSqQAsR5z9K25mGJG06TfshzVz3F2jmbQ9nnutkeWdKKpXONAbSIDVm0qlUerwToUqNS6cyzoIql0k1OAmqXEPKOdBQQSJIBIkgESSCRJAIEgkSQSJIBIkgESSCRJBIkAgSQSJIBIkgESSCRIJEkAgSQSJIBIkgESQSJIJEkAgSQSJIBIkgkSARJIJEkAgSQSJIJEgEiSARJIJEkAgSQSJBIkgEiSARJIJEkAgSCRJBIkgEiSARJIJEkEiQCBJBIkgEiSARJIJEgkSQCBJBIkgEiSCRIBEkgkSQCBJBIkgEiQSJIBEkgkSQCBJBIkgkSASJIBEkgkSQCBJBIkEiSASJIBEkgkSQCBIJEkEiSASJIBEkgkSQSJAIEkEiSASJIBEkEiSCRJAIEkEiSASJIJEgESSCRJAIEkEiSASJBIkgESSCRJAIEkEiSCRIBIkgESSCRJAIEkEiQSJIBIkgESSCRJBIkAgSQSJIBIkgESSCRIJEiUZysu3yvmrfc/hEvnzV/raS2n88dmaQn1i2ttBuSMZk32TLan547Z6SVauyA5Rb8vmRAX7igGv7ehySekHS07zWrliDv2dzFyRJRZLNztkXb/AzP+mGJKlIstkNsQafzc7+GZLEIsluiYckm2uDJBFImuf21lw01J3xkGSzayBJApInwq//Orh9fv9Q5+ZLBr++K6zzyPdbHs0Vxr+xHEn/2kJ5SOoCyaXyX86MZt9aMvgNRd975p1c+ZPOIGsTUmKQBMGhqeGjC4cY/KmH+jdXjkKSLCTB2vDRqf8MMfju5ZGSJZAkDEk+egPbPtTgLy6OlOyDJFlIgoXhw18MOfiOGeGxRyBJGJKV0UeUoQe/PXoq2QtJspB8FD785tCDz88KD74FSbKQvBA+/EGMwW8MD94HSTLfk2yNMfij0evNMUgS+elmZ5xnhxlFoiBJCJLN0T7J2ThInim6ggNJMpAcmzasj7XrwqMritauOV1cJyT1hOTw/dG7jG2xkLSERxcXrU3eJeAEITlVmPK8fCwk28KjCyCpbyRz1vT27APNle4nGRjJ19GdBZAk7860AonKSFqLrhlDkiQkq4OYSDaER5+CJGFImrcHcZG8ER5dCUmikORWnAhiI1lUdDUwWvtce3E/lH/j7x++V+jTvyEZS0gWrO8oXlURSVeu6OaT2Jtp/97aVNQV90JS20hmLO1t+ap1Ld+eLVtVcfDfRc8+54aH5K6m0l6CZIzskwxUxcGvCA8+FgwPyeQyJNdDUqdITkevNh8PE0mZkaarIalTJK9ErzZ/jgDJhBd3TWpqmgxJfSLZWfpbfNUgmfBaEPx0JSR1iuR4dDPJtM7qkfQYgaRukRyMjGTXBlUgmfTZTZGRA15uaqlzO9Zt+WVUkHS3RDeeZBflq0Ay8UAQ3FIwAknNtHd2zwhfz48YycnW2f3bb3d3BFUgmXLh0h+39RuBpFbqnN43w03VIHmyNazl3efnX76LfyioBknTDRf6/tpnBJJaaX30RjNfBZJBmrU/qA5JqCQ0AkmttDSa7K+jhmRhR1Atkl4lkRFIaqVlxb8lM3Ikube7g+qRXFLSbwSSWmlTOMPpF0cFSe7V07H3VAbeJ5kysQmSGqtrTt8M24JRQPLg+6fi76mUdlXZtZtrIamRjvf870TNW4MRIWmeu2jZ6h2dw9hTKe/GMiR3QlIrXfxtx+6zNfDv+OOaEiPXnYdEJZ1/+vabC93x8n8BJKr/IBEkgkSQCBJBIkgEiQSJIBEkgkSQaCwhaXAOVLmGVMZJUOUyqfR4Z0GVGpdOpdKZRidCg9WYSaf+BwrW/g4sKOtDAAAAAElFTkSuQmCC", this.successVideoImage = this.options.images.hasOwnProperty("successVideoImage") ? this.options.images.successVideoImage : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAfQAAAD6CAYAAABXq7VOAAAABGdBTUEAALGPC/xhBQAAEpNJREFUeAHt3UtsXOd1B/BvJPFlWaRIPWxZcQLHUSorsEwLltMEMRzYQJBsvEi66C4IkFW7aldZpkHQbRdFu6nX3dVAgGyCAOkiruvIcfwCEtlyJAe2RSUUORJpmZRIccIrWX6QQ3Ie987cOfc3G0szc7/vO79zjL9mho/a3NylRnIjQIAAAQIEBlpg10Cf3uEJECBAgACBWwIC3SAQIECAAIEAAgI9QBOVQIAAAQIEBLoZIECAAAECAQQEeoAmKoEAAQIECAh0M0CAAAECBAIICPQATVQCAQIECBAQ6GaAAAECBAgEEBDoAZqoBAIECBAgINDNAAECBAgQCCAg0AM0UQkECBAgQECgmwECBAgQIBBAQKAHaKISCBAgQICAQDcDBAgQIEAggIBAD9BEJRAgQIAAAYFuBggQIECAQAABgR6giUogQIAAAQIC3QwQIECAAIEAAgI9QBOVQIAAAQIEBLoZIECAAAECAQQEeoAmKoEAAQIECAh0M0CAAAECBAIICPQATVQCAQIECBAQ6GaAAAECBAgEEBDoAZqoBAIECBAgINDNAAECBAgQCCAg0AM0UQkECBAgQECgmwECBAgQIBBAQKAHaKISCBAgQICAQDcDBAgQIEAggIBAD9BEJRAgQIAAAYFuBggQIECAQAABgR6giUogQIAAAQIC3QwQIECAAIEAAgI9QBOVQIAAAQIEBLoZIECAAAECAQQEeoAmKoEAAQIECAh0M0CAAAECBAIICPQATVQCAQIECBAQ6GaAAAECBAgEEBDoAZqoBAIECBAgINDNAAECBAgQCCAg0AM0UQkECBAgQECgmwECBAgQIBBAQKAHaKISCBAgQICAQDcDBAgQIEAggIBAD9BEJRAgQIAAAYFuBggQIECAQAABgR6giUogQIAAAQIC3QwQIECAAIEAAgI9QBOVQIAAAQIEBLoZIECAAAECAQQEeoAmKoEAAQIECAh0M0CAAAECBAIICPQATVQCAQIECBAQ6GaAAAECBAgEEBDoAZqoBAIECBAgINDNAAECBAgQCCAg0AM0UQkECBAgQECgmwECBAgQIBBAQKAHaKISCBAgQICAQDcDBAgQIEAggIBAD9BEJRAgQIAAAYFuBggQIECAQAABgR6giUogQIAAAQIC3QwQIECAAIEAAgI9QBOVQIAAAQIEBLoZIECAAAECAQQEeoAmKoEAAQIECAh0M0CAAAECBAIICPQATVQCAQIECBAQ6GaAAAECBAgEEBDoAZqoBAIECBAgINDNAAECBAgQCCAg0AM0UQkECBAgQECgmwECBAgQIBBAQKAHaKISCBAgQICAQDcDBAgQIEAggIBAD9BEJRAgQIAAAYFuBggQIECAQAABgR6giUogQIAAAQIC3QwQIECAAIEAAgI9QBOVQIAAAQIEBLoZIECAAAECAQQEeoAmKoEAAQIECAh0M0CAAAECBAIICPQATVQCAQIECBAQ6GaAAAECBAgEEBDoAZqoBAIECBAgINDNAAECBAgQCCAg0AM0UQkECBAgQECgmwECBAgQIBBAQKAHaKISCBAgQICAQDcDBAgQIEAggIBAD9BEJRAgQIAAAYFuBggQIECAQAABgR6giUogQIAAAQIC3QwQIECAAIEAAgI9QBOVQIAAAQIEBLoZIECAAAECAQQEeoAmKoEAAQIECAh0M0CAAAECBAIICPQATVQCAQIECBAQ6GaAAAECBAgEEBDoAZqoBAIECBAgINDNAAECBAgQCCAg0AM0UQkECBAgQECgmwECBAgQIBBAQKAHaKISCBAgQICAQDcDBAgQIEAggIBAD9BEJRAgQIAAAYFuBggQIECAQAABgR6giUogQIAAAQIC3QwQIECAAIEAAgI9QBOVQIAAAQIEBLoZIECAAAECAQQEeoAmKoEAAQIECAh0M0CAAAECBAIICPQATVQCAQIECBAQ6GaAAAECBAgEEBDoAZqoBAIECBAgINDNAAECBAgQCCAg0AM0UQkECBAgQECgmwECBAgQIBBAQKAHaKISCBAgQICAQDcDBAgQIEAggIBAD9BEJRAgQIAAAYFuBggQIECAQAABgR6giUogQIAAAQIC3QwQIECAAIEAAgI9QBOVQIAAAQIEBLoZIECAAAECAQQEeoAmKoEAAQIECAh0M0CAAAECBAIICPQATVQCAQIECBAQ6GaAAAECBAgEEBDoAZqoBAIECBAgINDNAAECBAgQCCAg0AM0UQkECBAgQECgmwECBAgQIBBAQKAHaKISCBAgQICAQDcDBAgQIEAggIBAD9BEJRAgQIAAAYFuBggQIECAQAABgR6giUogQIAAAQIC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", this.successFileAltImage = this.options.images.hasOwnProperty("successFileAltImage") ? this.options.images.successFileAltImage : "data:image/png;base64,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", this.backgroundImage = this.options.images.hasOwnProperty("backgroundImage") ? this.options.images.backgroundImage : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAiQAAAD6CAYAAACRWFwGAAAABGdBTUEAALGPC/xhBQAADFNJREFUeAHt2jFOG1EUQNH5VpBGLnEVxB7CDpJVZRHZSLaRLIE9IFy5tSwRaTKjpEOU1i18XFmA7OfzXnEFjGl9nM+nx8vlz49lmb5N0/J5+5oHAQIECBAgQOB6AuM4xvRrnj993+8PL+NfjLw9rzFyf7039coECBAgQIAAgfcCa5Sc5vnuaff/NyNi5L2RrxAgQIAAAQJXFlh/IXLYWmS3Pvl65ffy8gQIECBAgACBDwW2Ftmt/zPy8OFP+AYBAgQIECBA4OoCy8MaJB4ECBAgQIAAgVZAkLT+3p0AAQIECBBYBQSJMyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQCwiSfAUGIECAAAECBASJGyBAgAABAgRyAUGSr8AABAgQIECAgCBxAwQIECBAgEAuIEjyFRiAAAECBAgQECRugAABAgQIEMgFBEm+AgMQIECAAAECgsQNECBAgAABArmAIMlXYAACBAgQIEBAkLgBAgQIECBAIBcQJPkKDECAAAECBAgIEjdAgAABAgQI5AKCJF+BAQgQIECAAAFB4gYIECBAgACBXECQ5CswAAECBAgQICBI3AABAgQIECCQC6xBMl7zKQxAgAABAgQI3LDAeN2NMf2+YQEfnQABAgQIEIgFthYZ5/Pp8XJ5e16W6T6ex9sTIECAAAECNyawxshpnu+edvv94WV98mWM8XP9883xxhx8XAIECBAgQCARGMetPbYY2VrkL3ZQPayX+qtWAAAAAElFTkSuQmCC", this.bindClickEvents(), this.imagePreview.style.backgroundImage = 'url("'.concat(this.baseImage, '")'), this.options.presetFiles = this.options.hasOwnProperty("presetFiles") ? this.options.presetFiles : null, this.options.presetFiles && this.addImagesFromPath(this.options.presetFiles).then(function() {}).catch(function(A) {
                    console.log("Error - " + A.toString()), console.log("Warning - An image you added from a path is not able to be added to the cachedFileArray.")
                })
            }
            return n()(A, [{
                key: "bindClickEvents",
                value: function() {
                    var A = this,
                        e = this;
                    e.input.addEventListener("change", function() {
                        e.addFiles(this.files)
                    }, !0), this.clearButton.addEventListener("click", function() {
                        A.clearPreviewPanel()
                    }, !0), this.imagePreview.addEventListener("click", function(e) {
                        if (e.target.matches(".custom-file-container__image-multi-preview__single-image-clear__icon")) {
                            var g = e.target.getAttribute("data-upload-token"),
                                B = A.cachedFileArray.findIndex(function(A) {
                                    return A.token === g
                                });
                            A.deleteFileAtIndex(B)
                        }
                    })
                }
            }, {
                key: "addFiles",
                value: function(A) {
                    if (0 !== A.length) {
                        this.input.multiple ? this.currentFileCount += A.length : (this.currentFileCount = A.length, this.cachedFileArray = []);
                        for (var e = 0; e < A.length; e++) {
                            var g = A[e];
                            g.token = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15), this.cachedFileArray.push(g), this.processFile(g)
                        }
                        var B = new CustomEvent("fileUploadWithPreview:imagesAdded", {
                            detail: {
                                uploadId: this.uploadId,
                                cachedFileArray: this.cachedFileArray,
                                addedFilesCount: A.length
                            }
                        });
                        window.dispatchEvent(B)
                    }
                }
            }, {
                key: "processFile",
                value: function(A) {
                    var e = this;
                    0 === this.currentFileCount ? this.inputLabel.innerHTML = this.options.text.chooseFile : 1 === this.currentFileCount ? this.inputLabel.innerHTML = A.name : this.inputLabel.innerHTML = "".concat(this.currentFileCount, " ").concat(this.options.text.selectedCount), this.addBrowseButton(this.options.text.browse), this.imagePreview.classList.add("custom-file-container__image-preview--active");
                    var g = new FileReader;
                    g.readAsDataURL(A), g.onload = function() {
                        e.input.multiple || (A.type.match("image/png") || A.type.match("image/jpeg") || A.type.match("image/gif") ? e.imagePreview.style.backgroundImage = 'url("'.concat(g.result, '")') : A.type.match("application/pdf") ? e.imagePreview.style.backgroundImage = 'url("'.concat(e.successPdfImage, '")') : A.type.match("video/*") ? e.imagePreview.style.backgroundImage = 'url("'.concat(e.successVideoImage, '")') : e.imagePreview.style.backgroundImage = 'url("'.concat(e.successFileAltImage, '")')), e.input.multiple && (e.imagePreview.style.backgroundImage = 'url("'.concat(e.backgroundImage, '")'), A.type.match("image/png") || A.type.match("image/jpeg") || A.type.match("image/gif") ? e.options.showDeleteButtonOnImages ? e.imagePreview.innerHTML += '\n                            <div\n                                class="custom-file-container__image-multi-preview"\n                                data-upload-token="'.concat(A.token, '"\n                                style="background-image: url(\'').concat(g.result, '\'); "\n                            >\n                                <span class="custom-file-container__image-multi-preview__single-image-clear">\n                                    <span\n                                        class="custom-file-container__image-multi-preview__single-image-clear__icon"\n                                        data-upload-token="').concat(A.token, '"\n                                    >&times;</span>\n                                </span>\n                            </div>\n                        ') : e.imagePreview.innerHTML += '\n                            <div\n                                class="custom-file-container__image-multi-preview"\n                                data-upload-token="'.concat(A.token, '"\n                                style="background-image: url(\'').concat(g.result, "'); \"\n                            ></div>\n                        ") : A.type.match("application/pdf") ? e.options.showDeleteButtonOnImages ? e.imagePreview.innerHTML += '\n                            <div\n                                class="custom-file-container__image-multi-preview"\n                                data-upload-token="'.concat(A.token, '"\n                                style="background-image: url(\'').concat(e.successPdfImage, '\'); "\n                            >\n                                <span class="custom-file-container__image-multi-preview__single-image-clear">\n                                    <span\n                                        class="custom-file-container__image-multi-preview__single-image-clear__icon"\n                                        data-upload-token="').concat(A.token, '"\n                                    >&times;</span>\n                                </span>\n                            </div>\n                        ') : e.imagePreview.innerHTML += '\n                            <div\n                                class="custom-file-container__image-multi-preview"\n                                data-upload-token="'.concat(A.token, '"\n                                style="background-image: url(\'').concat(e.successPdfImage, "'); \"\n                            ></div>\n                        ") : A.type.match("video/*") ? e.options.showDeleteButtonOnImages ? e.imagePreview.innerHTML += '\n                            <div\n                                class="custom-file-container__image-multi-preview"\n                                style="background-image: url(\''.concat(e.successVideoImage, '\'); "\n                                data-upload-token="').concat(A.token, '"\n                            >\n                                <span class="custom-file-container__image-multi-preview__single-image-clear">\n                                    <span\n                                        class="custom-file-container__image-multi-preview__single-image-clear__icon"\n                                        data-upload-token="').concat(A.token, '"\n                                    >&times;</span>\n                                </span>\n                            </div>\n                        ') : e.imagePreview.innerHTML += '\n                            <div\n                                class="custom-file-container__image-multi-preview"\n                                style="background-image: url(\''.concat(e.successVideoImage, '\'); "\n                                data-upload-token="').concat(A.token, '"\n                            ></div>\n                        ') : e.options.showDeleteButtonOnImages ? e.imagePreview.innerHTML += '\n                            <div\n                                class="custom-file-container__image-multi-preview"\n                                style="background-image: url(\''.concat(e.successFileAltImage, '\'); "\n                                data-upload-token="').concat(A.token, '"\n                            >\n                                <span class="custom-file-container__image-multi-preview__single-image-clear">\n                                    <span\n                                        class="custom-file-container__image-multi-preview__single-image-clear__icon"\n                                        data-upload-token="').concat(A.token, '"\n                                    >&times;</span>\n                                </span>\n                            </div>\n                        ') : e.imagePreview.innerHTML += '\n                            <div\n                                class="custom-file-container__image-multi-preview"\n                                style="background-image: url(\''.concat(e.successFileAltImage, '\'); "\n                                data-upload-token="').concat(A.token, '"\n                            ></div>\n                        '))
                    }
                }
            }, {
                key: "addImagesFromPath",
                value: function(A) {
                    var e = this;
                    return new Promise(function() {
                        var g = C()(E.a.mark(function g(B, t) {
                            var C, I, Q, i, n;
                            return E.a.wrap(function(g) {
                                for (;;) switch (g.prev = g.next) {
                                    case 0:
                                        C = [], I = 0;
                                    case 2:
                                        if (!(I < A.length)) {
                                            g.next = 24;
                                            break
                                        }
                                        return Q = void 0, i = void 0, g.prev = 5, g.next = 8, fetch(A[I], {
                                            mode: "cors"
                                        });
                                    case 8:
                                        return Q = g.sent, g.next = 11, Q.blob();
                                    case 11:
                                        i = g.sent, g.next = 18;
                                        break;
                                    case 14:
                                        return g.prev = 14, g.t0 = g.catch(5), t(g.t0), g.abrupt("continue", 21);
                                    case 18:
                                        (n = new Blob([i], {
                                            type: i.type
                                        })).name = A[I].split("/").pop(), C.push(n);
                                    case 21:
                                        I++, g.next = 2;
                                        break;
                                    case 24:
                                        e.addFiles(C), B();
                                    case 26:
                                    case "end":
                                        return g.stop()
                                }
                            }, g, null, [
                                [5, 14]
                            ])
                        }));
                        return function(A, e) {
                            return g.apply(this, arguments)
                        }
                    }())
                }
            }, {
                key: "replaceFiles",
                value: function(A) {
                    if (!A.length) throw new Error("Array must contain at least one file.");
                    this.cachedFileArray = A, this.refreshPreviewPanel()
                }
            }, {
                key: "replaceFileAtIndex",
                value: function(A, e) {
                    if (!A) throw new Error("No file found.");
                    if (!this.cachedFileArray[e]) throw new Error("There is no file at index", e);
                    this.cachedFileArray[e] = A, this.refreshPreviewPanel()
                }
            }, {
                key: "deleteFileAtIndex",
                value: function(A) {
                    if (!this.cachedFileArray[A]) throw new Error("There is no file at index", A);
                    this.cachedFileArray.splice(A, 1), this.refreshPreviewPanel();
                    var e = new CustomEvent("fileUploadWithPreview:imageDeleted", {
                        detail: {
                            uploadId: this.uploadId,
                            cachedFileArray: this.cachedFileArray,
                            currentFileCount: this.currentFileCount
                        }
                    });
                    window.dispatchEvent(e)
                }
            }, {
                key: "refreshPreviewPanel",
                value: function() {
                    var A = this;
                    this.imagePreview.innerHTML = "", this.currentFileCount = this.cachedFileArray.length, this.cachedFileArray.forEach(function(e) {
                        return A.processFile(e)
                    }), this.cachedFileArray.length || this.clearPreviewPanel()
                }
            }, {
                key: "addBrowseButton",
                value: function(A) {
                    this.inputLabel.innerHTML += '<span class="custom-file-container__custom-file__custom-file-control__button"> '.concat(A, " </span>")
                }
            }, {
                key: "emulateInputSelection",
                value: function() {
                    this.input.click()
                }
            }, {
                key: "clearPreviewPanel",
                value: function() {
                    this.input.value = "", this.inputLabel.innerHTML = this.options.text.chooseFile, this.addBrowseButton(this.options.text.browse), this.imagePreview.style.backgroundImage = 'url("'.concat(this.baseImage, '")'), this.imagePreview.classList.remove("custom-file-container__image-preview--active"), this.cachedFileArray = [], this.imagePreview.innerHTML = "", this.currentFileCount = 0
                }
            }]), A
        }()),
        a = g(9),
        r = new o("myFirstImage");
    document.querySelector(".upload-info-button--first").addEventListener("click", function() {
        console.log("First upload:", r, r.cachedFileArray)
    });
    var s = new o("mySecondImage", {
        showDeleteButtonOnImages: !0,
        text: {
            chooseFile: "Custom Placeholder Copy",
            browse: "Custom Button Copy",
            selectedCount: "Custom Files Selected Copy"
        },
        images: {
            baseImage: a
        },
        presetFiles: ["./badge.png", "https://images.unsplash.com/photo-1557090495-fc9312e77b28?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=668&q=80"]
    });
    document.querySelector(".upload-info-button--second").addEventListener("click", function() {
        console.log("Second upload:", s, s.cachedFileArray)
    }), window.addEventListener("fileUploadWithPreview:imagesAdded", function(A) {
        "myFirstImage" === A.detail.uploadId && (console.log(A.detail.addedFilesCount), console.log(A.detail.cachedFileArray)), "mySecondImage" === A.detail.uploadId && (console.log(A.detail.addedFilesCount), console.log(A.detail.cachedFileArray))
    }), window.addEventListener("fileUploadWithPreview:imageDeleted", function(A) {
        "mySecondImage" === A.detail.uploadId && (console.log(A.detail.currentFileCount), console.log(A.detail.cachedFileArray))
    })
}]);