(function() {
  return tinymce.PluginManager.add("masterpiece_shortcodes", function(editor) {
    var grid;
    grid = new Array(12);
    grid[0] = "[masterpiece_col size=12]TEXT[/masterpiece_col]<br/>";
    grid[1] = "[masterpiece_col size=6]TEXT[/masterpiece_col]<br/>";
    grid[1] += "[masterpiece_col size=6]TEXT[/masterpiece_col]<br/>";
    grid[2] = "[masterpiece_col size=4]TEXT[/masterpiece_col]<br/>";
    grid[2] += "[masterpiece_col size=4]TEXT[/masterpiece_col]<br/>";
    grid[2] += "[masterpiece_col size=4]TEXT[/masterpiece_col]<br/>";
    grid[3] = "[masterpiece_col size=4]TEXT[/masterpiece_col]<br/>";
    grid[3] += "[masterpiece_col size=8]TEXT[/masterpiece_col]<br/>";
    grid[4] = "[masterpiece_col size=3]TEXT[/masterpiece_col]<br/>";
    grid[4] += "[masterpiece_col size=6]TEXT[/masterpiece_col]<br/>";
    grid[4] += "[masterpiece_col size=3]TEXT[/masterpiece_col]<br/>";
    grid[5] = "[masterpiece_col size=3]TEXT[/masterpiece_col]<br/>";
    grid[5] += "[masterpiece_col size=3]TEXT[/masterpiece_col]<br/>";
    grid[5] += "[masterpiece_col size=3]TEXT[/masterpiece_col]<br/>";
    grid[5] += "[masterpiece_col size=3]TEXT[/masterpiece_col]<br/>";
    grid[6] = "[masterpiece_col size=3]TEXT[/masterpiece_col]<br/>";
    grid[6] += "[masterpiece_col size=9]TEXT[/masterpiece_col]<br/>";
    grid[7] = "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[7] += "[masterpiece_col size=8]TEXT[/masterpiece_col]<br/>";
    grid[7] += "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[8] = "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[8] += "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[8] += "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[8] += "[masterpiece_col size=6]TEXT[/masterpiece_col]<br/>";
    grid[9] = "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[9] += "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[9] += "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[9] += "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[9] += "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[9] += "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[10] = "[masterpiece_col size=8]TEXT[/masterpiece_col]<br/>";
    grid[10] += "[masterpiece_col size=4]TEXT[/masterpiece_col]<br/>";
    grid[11] = "[masterpiece_col size=10]TEXT[/masterpiece_col]<br/>";
    grid[11] += "[masterpiece_col size=2]TEXT[/masterpiece_col]<br/>";
    grid[12] = "[masterpiece_col size=5]TEXT[/masterpiece_col]<br/>";
    grid[12] += "[masterpiece_col size=7]TEXT[/masterpiece_col]<br/>";
    return editor.addButton("masterpiece_shortcodes", {
      type: "splitbutton",
      title: masterpiece_toolkit.i18n.shortcodes,
      icon: "masterpiece_shortcodes",
      menu: [
        {
          text: masterpiece_toolkit.i18n.grid,
          menu: [
            {
              text: "1/1",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[0] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/2 - 1/2",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[1] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/3 - 1/3 - 1/3",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[2] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/3 - 2/3",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[3] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/4 - 1/2 - 1/4",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[4] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/4 - 1/4 - 1/4 - 1/4",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[5] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/4 - 3/4",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[6] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/6 - 4/6 - 1/6",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[7] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/6 - 1/6 - 1/6 - 1/2",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[8] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[9] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "2/3 - 1/3",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[10] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: "5/6 - 1/6",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[11] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            },{
              text: "5/12 - 7/12",
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_row]<br/>" + grid[12] + "[/masterpiece_row]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }
          ]
        },{
          text: masterpiece_toolkit.i18n.container,
          menu: [
            {
              text: masterpiece_toolkit.i18n.tabs,
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_tabs]<br/>";
                shortcode += "[masterpiece_tab title=\"Tab title 1\"]Tab content 1[/masterpiece_tab]<br/>";
                shortcode += "[masterpiece_tab title=\"Tab title 2\"]Tab content 2[/masterpiece_tab]<br/>";
                shortcode += "[masterpiece_tab title=\"Tab title 3\"]Tab content 3[/masterpiece_tab]<br/>";
                shortcode += "[/masterpiece_tabs]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: masterpiece_toolkit.i18n.accordion,
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_accordions]<br/>";
                shortcode += "[masterpiece_accordion title=\"Accordion title 1\"]Accordion content 1[/masterpiece_accordion]<br/>";
                shortcode += "[masterpiece_accordion title=\"Accordion title 2\"]Accordion content 2[/masterpiece_accordion]<br/>";
                shortcode += "[masterpiece_accordion title=\"Accordion title 3\"]Accordion content 3[/masterpiece_accordion]<br/>";
                shortcode += "[/masterpiece_accordions]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }, {
              text: masterpiece_toolkit.i18n.toggle,
              onclick: function() {
                var shortcode;
                shortcode = "[masterpiece_toggles]<br/>";
                shortcode += "[masterpiece_toggle title=\"Toggle title 1\"]Toggle content 1[/masterpiece_toggle]<br/>";
                shortcode += "[masterpiece_toggle title=\"Toggle title 2\"]Toggle content 2[/masterpiece_toggle]<br/>";
                shortcode += "[masterpiece_toggle title=\"Toggle title 3\"]Toggle content 3[/masterpiece_toggle]<br/>";
                shortcode += "[/masterpiece_toggles]<br/>";
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, shortcode);
              }
            }
          ]
        }, {
          text: masterpiece_toolkit.i18n.dropcap,
          icon: "dropcap",
          menu: [
            {
              text: masterpiece_toolkit.i18n.dc_bg,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_dropcap class=\"firstletter\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_dropcap]");
              }
            }, {
              text: masterpiece_toolkit.i18n.dc_bd,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_dropcap class=\"firstletter-02\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_dropcap]");
              }
            },
          ]
        }, {
          text: masterpiece_toolkit.i18n.blockquote,
          menu: [
            {
              text: masterpiece_toolkit.i18n.bq_border_left,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_blockquote class=\"master-widget-blockquote\" author=\"The author name\" author_url=\"#\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_blockquote]");
              }
            }, {
              text: masterpiece_toolkit.i18n.bq_border,
              onclick: function() {
                return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_blockquote class=\"master-widget-blockquote master-other\" author=\"The author name\" author_url=\"#\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_blockquote]");
              }
            }
          ]
        }, {
          text: masterpiece_toolkit.i18n.button,
          menu: [
            {
              text: masterpiece_toolkit.i18n.bt_bg,
              menu: [
                {
                  text: masterpiece_toolkit.i18n.small,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_button class=\"master-widget-button master-widget-button-1\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_button]");
                  }
                }, {
                  text: masterpiece_toolkit.i18n.medium,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_button class=\"master-widget-button master-widget-button-2\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_button]");
                  }
                }, {
                  text: masterpiece_toolkit.i18n.large,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_button class=\"master-widget-button master-widget-button-3\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_button]");
                  }
                }, {
                  text: masterpiece_toolkit.i18n.large_text,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_button class=\"master-widget-button master-widget-button-4\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_button]");
                  }
                }
              ]
            }, {
              text: masterpiece_toolkit.i18n.bt_border,
              menu: [
                {
                  text: masterpiece_toolkit.i18n.small,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_button class=\"master-widget-button master-widget-button-5\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_button]");
                  }
                }, {
                  text: masterpiece_toolkit.i18n.medium,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_button class=\"master-widget-button master-widget-button-6\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_button]");
                  }
                }, {
                  text: masterpiece_toolkit.i18n.large,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_button class=\"master-widget-button master-widget-button-7\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_button]");
                  }
                }, {
                  text: masterpiece_toolkit.i18n.large_text,
                  onclick: function() {
                    return tinyMCE.activeEditor.execCommand("mceInsertContent", 0, "[masterpiece_button class=\"master-widget-button master-widget-button-8\" link=\"#\" target=\"\"]" + tinyMCE.activeEditor.selection.getContent() + "[/masterpiece_button]");
                  }
                }
              ]
            }
          ]
        }
      ]
    });
  });
})();
