Ext.application({
    name: "DataDikdasRegistrasi",
    launch: function() {
        var e = "http://localhost:6969/prefill/push_prefill.php";
        Ext.apply(Ext.form.VTypes, {
            password: function(e, t) {
                if (t.initialPassField) {
                    var n = Ext.getCmp(t.initialPassField);
                    return e == n.getValue()
                }
                return true
            },
            passwordText: "Password tidak sama!"
        });
        Ext.define("KitchenSink.view.form.RegistrasiForm", {
            extend: "Ext.form.Panel",
            xtype: "registrasi-form",
            frame: false,
            border: false,
            width: 400,
            labelWidth: 200,
            bodyPadding: "10 10 10 10",
            defaultType: "textfield",
            fieldDefaults: {
                msgTarget: "side",
                labelWidth: 130
            },
            defaults: {
                anchor: "100%"
            },
            items: [{
                allowBlank: false,
                fieldLabel: "Peran ID",
                name: "peran_id",
                hidden: true,
                value: 10
            }, {
                xtype: "displayfield",
                allowBlank: false,
                fieldLabel: "Peran",
                value: "<b>Operator Sekolah</b>"
            }, {
                allowBlank: false,
                fieldLabel: "Nama lengkap",
                name: "nama",
                emptyText: "Nama lengkap..."
            }, {
                allowBlank: false,
                fieldLabel: "Username (Email)",
                name: "username",
                emptyText: "Username...",
                vtype: "email"
            }, {
                allowBlank: false,
                fieldLabel: "Password",
                name: "password",
                id: "password",
                emptyText: "Password...",
                inputType: "password"
            }, {
                allowBlank: false,
                fieldLabel: "Konfirmasi password",
                name: "password_confirm",
                emptyText: "Konfirmasi password...",
                inputType: "password",
                vtype: "password",
                initialPassField: "password"
            }, {
                allowBlank: false,
                fieldLabel: "Nomor HP",
                name: "no_hp",
                emptyText: "Nomor HP...",
                anchor: "80%",
                regex: /^0[0-9]{7,12}\b/
            }, {
                fieldLabel: "Nomor telepon",
                name: "no_telepon",
                emptyText: "Nomor telepon...",
                anchor: "80%",
                regex: /^0[0-9]{6,11}\b/
            }, {
                fieldLabel: "Yahoo Messenger",
                name: "ym",
                emptyText: "Yahoo Messenger...",
                anchor: "80%",
                maxLength: 20,
                enforceMaxLength: true
            }, {
                fieldLabel: "Skype",
                name: "skype",
                emptyText: "Skype...",
                anchor: "80%",
                maxLength: 20,
                enforceMaxLength: true
            }, {
                allowBlank: false,
                fieldLabel: "Kode registrasi",
                name: "kode_registrasi",
                emptyText: "Kode registrasi...",
                anchor: "80%"
            }],
            buttons: [{
                text: "Simpan",
                handler: function() {
                    var t = this.up("registrasi-form").getForm();
                    Ext.MessageBox.show({
                        msg: "Please wait...",
                        progressText: "Please wait...",
                        width: 200,
                        wait: true
                    });
                    var n = t.findField("kode_registrasi").getValue();
                    if (t.isValid()) {
                        Ext.ux.JSONP.request(e, {
                            callbackKey: "jsoncallback",
                            params: {
                                kode_registrasi: n
                            },
                            callback: function(e) {
                                var n = e.status;
                                var r = e.kode;
                                var i = e.message;
                                if (n == 1) {
                                    t.submit({
                                        clientValidation: true,
                                        url: "/registration",
                                        submitEmptyText: false,
                                        success: function(e, t) {
                                            var n = t.result;
                                            if (n.success) {
                                                Ext.MessageBox.hide();
                                                Ext.MessageBox.show({
                                                    title: "Berhasil",
                                                    msg: n.message,
                                                    buttons: Ext.MessageBox.YES,
                                                    buttonText: {
                                                        yes: "OK"
                                                    },
                                                    fn: function(e) {
                                                        window.location = "/login.html"
                                                    }
                                                })
                                            } else {
                                                Ext.MessageBox.alert("Gagal", n.message)
                                            }
                                        },
                                        failure: function(e, t) {
                                            var n = t.result;
                                            Ext.MessageBox.alert("Gagal", n.message)
                                        }
                                    })
                                } else {
                                    Ext.MessageBox.alert("Gagal", i)
                                }
                            }
                        })
                    } else {
                        Ext.Msg.alert("Error", "Silakan isi form dengan lengkap.")
                    }
                }
            }, {
                text: "Batal",
                icons: "cancel",
                handler: function() {
                    window.location = "/login.html"
                }
            }]
        });
        var t = new Ext.window.Window({
            autoHeight: true,
            resizable: false,
            closable: false,
            title: "Registrasi",
            autoScroll: false,
            frame: true,
            border: true,
            layout: "vbox",
            items: [{
                layout: "fit",
                border: false,
                items: [{
                    xtype: "registrasi-form"
                }]
            }]
        });
        t.show()
    }
})