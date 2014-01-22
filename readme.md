# Digital Hub

## Description

The Digital Hub website is a central repository for showing customers our full, Trinity Mirror wide, offering of digital adverts, build guides and example adverts.

## Dependencies

- PHP
- MySQL
- WordPress

## Instructions

### Install

Copy the `./_scripts/local-config.sample.php` file to the `digitalhub` folder and rename it `local-config.php`. Do the same with the `./_scripts/wp-config.sample.php` file renaming it to `wp-config.php`.

Fill in the `local-config.php` with your local MySQL database details.

Symlink the uploads folder to your local shared folder:

```
mkdir shared shared/content shared/content/uploads
cd content
ln -s ../shared/content/uploads uploads
cd ../
chmod 777 -r shared/content/uploads
```

Navigate to the home page, eg `http://localhost/digitalhub/`, and follow the default WordPress instructions.

## Documentation

During the Alpha/Beta stages, due to constant changes, documentation
will be mainly written in-line. With a dedicated section being created
at the first major release.

## Report Issues

If you spot any issues please create a ticket via GitHub's Issue
Tracker. If the issue is security related please use the contact
information below.

## Contribute

In lieu of a formal style guide, take care to maintain the existing
coding style.

## Contact

## Copyright

Unless otherwise stated © Trinity Mirror
