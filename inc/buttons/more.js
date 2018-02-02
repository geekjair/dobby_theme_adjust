(function() {
    tinymce.create('tinymce.plugins.success', {
        init : function(ed, url) {
            ed.addButton('success', {
                title : '绿色背景栏',
                image : url+'/images/success.png',
                onclick : function() {
                     ed.selection.setContent('[success]' + ed.selection.getContent() + '[/success]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('success', tinymce.plugins.success);

    tinymce.create('tinymce.plugins.info', {
        init : function(ed, url) {
            ed.addButton('info', {
                title : '蓝色背景栏',
                image : url+'/images/info.png',
                onclick : function() {
                     ed.selection.setContent('[info]' + ed.selection.getContent() + '[/info]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('info', tinymce.plugins.info);

    tinymce.create('tinymce.plugins.warning', {
        init : function(ed, url) {
            ed.addButton('warning', {
                title : '黄色背景栏',
                image : url+'/images/warning.png',
                onclick : function() {
                     ed.selection.setContent('[warning]' + ed.selection.getContent() + '[/warning]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('warning', tinymce.plugins.warning);

    tinymce.create('tinymce.plugins.danger', {
        init : function(ed, url) {
            ed.addButton('danger', {
                title : '红色背景栏',
                image : url+'/images/danger.png',
                onclick : function() {
                     ed.selection.setContent('[danger]' + ed.selection.getContent() + '[/danger]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('danger', tinymce.plugins.danger);       

    tinymce.create('tinymce.plugins.kbd', {
        init : function(ed, url) {
            ed.addButton('kbd', {
                title : '键盘文本',
                image : url+'/images/kbd.png',
                onclick : function() {
                     ed.selection.setContent('[kbd]' + ed.selection.getContent() + '[/kbd]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('kbd', tinymce.plugins.kbd);

    tinymce.create('tinymce.plugins.mark', {
        init : function(ed, url) {
            ed.addButton('mark', {
                title : '内容标记',
                image : url+'/images/mark.png',
                onclick : function() {
                     ed.selection.setContent('[mark]' + ed.selection.getContent() + '[/mark]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mark', tinymce.plugins.mark);

    tinymce.create('tinymce.plugins.striped', {
        init : function(ed, url) {
            ed.addButton('striped', {
                title : '进度条',
                image : url+'/images/striped.png',
                onclick : function() {
                     ed.selection.setContent('[striped]' + ed.selection.getContent() + '[/striped]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('striped', tinymce.plugins.striped);

    tinymce.create('tinymce.plugins.download', {
        init : function(ed, url) {
            ed.addButton('download', {
                title : '本地下载',
                image : url+'/images/download.png',
                onclick : function() {
                     ed.selection.setContent('[download title="本地下载"]' + ed.selection.getContent() + '[/download]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('download', tinymce.plugins.download);

    tinymce.create('tinymce.plugins.music', {
        init : function(ed, url) {
            ed.addButton('music', {
                title : '网易云音乐',
                image : url+'/images/music.png',
                onclick : function() {
                     ed.selection.setContent('[music]' + ed.selection.getContent() + '[/music]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('music', tinymce.plugins.music);

    tinymce.create('tinymce.plugins.youku', {
        init : function(ed, url) {
            ed.addButton('youku', {
                title : '优酷视频',
                image : url+'/images/youku.png',
                onclick : function() {
                     ed.selection.setContent('[youku]' + ed.selection.getContent() + '[/youku]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('youku', tinymce.plugins.youku);

    tinymce.create('tinymce.plugins.vqq', {
        init : function(ed, url) {
            ed.addButton('vqq', {
                title : '腾讯视频',
                image : url+'/images/vqq.png',
                onclick : function() {
                     ed.selection.setContent('[vqq auto="0"]' + ed.selection.getContent() + '[/vqq]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('vqq', tinymce.plugins.vqq);

    tinymce.create('tinymce.plugins.bilibili', {
        init : function(ed, url) {
            ed.addButton('bilibili', {
                title : '哔哩哔哩',
                image : url+'/images/bilibili.png',
                onclick : function() {
                     ed.selection.setContent('[bilibili cid=""]' + ed.selection.getContent() + '[/bilibili]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('bilibili', tinymce.plugins.bilibili);

    tinymce.create('tinymce.plugins.youtube', {
        init : function(ed, url) {
            ed.addButton('youtube', {
                title : 'YouTube',
                image : url+'/images/youtube.png',
                onclick : function() {
                     ed.selection.setContent('[youtube]' + ed.selection.getContent() + '[/youtube]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('youtube', tinymce.plugins.youtube); 
})();