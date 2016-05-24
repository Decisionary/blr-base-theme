# Buttons

BLR Base Theme allows for buttons in both `<button>` and `<a>` elements.  Regardless of which method you pick, the buttons should appear identical, giving you flexibility in implementation. That being said, if your button does not actually link to another page you should use a `<button>` element. When you do need to use an `<a>` element, you should add the `button` ARIA role for accessibility purposes (e.g.  `<a role="button" ...`).


## Button Variants

Buttons come in the following forms:

- `.button--default` - Default text color.
- `.button--primary` - Primary branding color.
- `.button--secondary` - Secondary branding color.
- `.button--tertiary` - Tertiary branding color.
- `.button--success` - Success state color.
- `.button--error` - Error state color.
- `.button--info` - Info state color.
- `.button--alert` - Alert state color.

## Sass Variables

Each button variant has its own set of Sass variables for customizing its color. These variables follow the format `$color-button-<variant>[-<state>]`. For example, the primary button variant uses the following variables:

    $color-button-primary
    $color-button-primary-hover
    $color-button-primary-focus
    $color-button-primary-active
    
There is also a variable you can use to change the default button background color:

    $background-color-button-default
