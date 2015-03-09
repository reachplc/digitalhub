# Digital Hub

## Description

The Digital Hub website is a central repository for showing customers our full, Trinity Mirror wide, offering of digital adverts, build guides and example adverts.

## Dependencies

- PHP
- MySQL
- WordPress

## Instructions

### Install

Clone repo.
```
git clone https://github.com/trinitymirror/digitalhub.git digitalhub
cd digitalhub
```

Activate the sub module.
```
git submodule update --init system/
git submodule update --init content/plugins/google-analytics-for-wordpress/
```

Copy the `scripts/sample.wp-config.php` file to the `web/` folder and rename it `wp-config.php`. Repeat the process with `scripts/sample.htaccess` file renaming it to `.htaccess`.

Fill in the `wp-config.php` with your local MySQL database details.

Navigate to the home page, eg `http://localhost/digitalhub/`, and follow the default WordPress instructions.

### Updating WordPress

To make this less complicated we include WordPress as a submodule.

To update the version of WordPress:

```
cd system
git fetch origin --tags
git checkout SHA
cd ../
git add system
git commit -m "Update WordPress to x.x.x"
```

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
