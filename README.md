# rdm-phpspec-customsuffix

PHPSpec is a highly opinionated tool, and is hard-coded to deal with class files that use only
the .php filename extension. While this may be a good practice, it keeps people from adopting
it as a test framework if their existing code-base doesn't exactly follow it's recommended
practices, without a tremendous amount of disruptive change.

And, disruptive change to an untested code-base is bad, yeah?

Within the PHP community, different conventions have been used over the years for filenames.
Different communities have different opinions on PHP class file naming conventions, for better
or worse. Some communities use suffixes like `*.class.php`, some use `*.inc.php`, some even use
prefixes like `class-*.php` (although this plugin doesn't support prefixes at this time).

In order to add a little flexibility to PHPSpec, this plugin allows you to specify on a
suite-by-suite basis different filename suffix/extension conventions.

Configuring custom suffixes in `phpspec.yml`:

```yaml
suites:
  really_old_stuff:
    src_path: thing/includes
    spec_path: thing
    src_extension: .inc.php
  old_stuff:
    src_path: newer_thing/classes
    spec_path: newer_thing
    src_extension: .class.php
extensions: [RDM\CustomSuffix\Extension]
```
