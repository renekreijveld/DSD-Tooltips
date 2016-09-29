DSD Tooltips
============

This plugin generates Bootstrap 3 compatible tooltips.

##Requirements

Bootstrap 3 CSS and Bootstrap 3 Javascript with jQuery must be loaded for the tooltips to work.

##Usage

```
{tooltip linktext=linktext to show|tiptitle=Tooltip|tiptext=Lorem ipsum dolor sit amet.|trigger=hover|showdelay=500|hidedelay=2500}
```

Separate all your parameters will the verticale 'pipe' symbol: |

##Parameters:

linktext: text to show in your content. This text will be shown as a link and hovering or click it will trigger the tooltip.

tiptitle (optional): Title to show at the top inside the tooltip.

tiptext: Text to show inside the tooltip. This can be plain html.

trigger (optional): Trigger to use for showing the tooltip. Can be 'click', 'hover' or 'focus'.

showdelay (optional): Delay in milliseconds to show the tooltip. This is ingored for trigger type 'click'.

hidedelay (optional): Delay in milliseconds to hide the tooltip. This is ingored for trigger type 'click'.

