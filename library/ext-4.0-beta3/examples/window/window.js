Ext.require([
    'Ext.window.Window',
    'Ext.tab.*',
    'Ext.toolbar.Spacer',
    'Ext.layout.container.Card',
    'Ext.layout.container.Border'
]);

Ext.onReady(function(){
    var floater, constrainedWin, constrainedWin2;

    Ext.util.Region.override({
        colours: ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'],
        nextColour: 0,
        show: function(){
            var style = {
                display: 'block',
                position: 'absolute',
                top: this.top + 'px',
                left: this.left + 'px',
                height: ((this.bottom - this.top) + 1) + 'px',
                width: ((this.right - this.left) + 1) + 'px',
                opacity: 0.3,
                'pointer-events': 'none',
                'z-index': 9999999
            };
            if (!this.highlightEl) {
                style['background-color'] = this.colours[this.nextColour];
                Ext.util.Region.prototype.nextColour++;
                this.highlightEl = Ext.getBody().createChild({
                    style: style
                });
                if (this.nextColour >= this.colours.length) {
                    this.nextColour = 0;
                }
            } else {
                this.highlightEl.setStyle(style);
            }
        },
        hide: function(){
            if (this.highlightEl) {
                this.highlightEl.setStyle({
                    display: 'none'
                });
            }
        }
    });

    var win2 = Ext.create('widget.window', {
        height: 200,
        width: 400,
        x: 450,
        y: 450,
        title: 'Constraining Window, plain: true',
        closable: false,
        plain: true,
        layout: 'fit',
        items: [floater = Ext.create('Ext.Component', {
            xtype: 'component',
            floating: {
                shadow: false
            },
            height: 50,
            width: 50,
            x: 175,
            y: 75
        }), constrainedWin = Ext.create('Ext.Window', {
            title: 'Constrained Window',
            width: 100,
            height: 100,
            x: 20,
            y: 20,
            constrain: true,
            layout: 'fit',
            items: {
                border: false
            }
        }), constrainedWin2 = Ext.create('Ext.Window', {
            title: 'Header-Constrained Win',
            width: 100,
            height: 100,
            x: 120,
            y: 120,
            constrainHeader: true,
            layout: 'fit',
            items: {
                border: false
            }
        }),{
            border: false
        }]
    });
    win2.show();
    floater.show();
    constrainedWin.show();
    constrainedWin2.show();

    Ext.create('Ext.Window', {
        title: 'Left Header, plain: true',
        width: 400,
        height: 200,
        x: 10,
        y: 200,
        plain: true,
        headerPosition: 'left',
        layout: 'fit',
        items: {
            border: false
        }
    }).show();

    Ext.create('Ext.Window', {
        title: 'Right Header, plain: true',
        width: 400,
        height: 200,
        x: 450,
        y: 200,
        headerPosition: 'right',
        layout: 'fit',
        items: {
            border: false
        }
    }).show();

    Ext.create('Ext.Window', {
        title: 'Bottom Header, plain: true',
        width: 400,
        height: 200,
        x: 10,
        y: 450,
        plain: true,
        headerPosition: 'bottom',
        layout: 'fit',
        items: {
            border: false
        }
    }).show();
});
