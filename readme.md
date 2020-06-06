![GitHub release (latest by date)](https://img.shields.io/github/v/release/darkterminal/twigniter) [![GitHub issues](https://img.shields.io/github/issues/darkterminal/twigniter)](https://github.com/darkterminal/twigniter/issues) [![GitHub forks](https://img.shields.io/github/forks/darkterminal/twigniter)](https://github.com/darkterminal/twigniter/network) [![GitHub stars](https://img.shields.io/github/stars/darkterminal/twigniter)](https://github.com/darkterminal/twigniter/stargazers) [![GitHub license](https://img.shields.io/github/license/darkterminal/twigniter)](https://github.com/darkterminal/twigniter/blob/master/license.txt) [![Twitter](https://img.shields.io/twitter/url?style=social&url=https%3A%2F%2Ftwitter.com%2Fddarkterminal)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Fdarkterminal%2Ftwigniter) ![GitHub repo size](https://img.shields.io/github/repo-size/darkterminal/twigniter) ![GitHub search hit counter](https://img.shields.io/github/search/darkterminal/twigniter/twigniter) ![GitHub All Releases](https://img.shields.io/github/downloads/darkterminal/twigniter/total) ![GitHub issues](https://img.shields.io/github/issues-raw/darkterminal/twigniter) ![GitHub pull request check contexts](https://img.shields.io/github/status/contexts/pulls/darkterminal/twigniter/1) ![GitHub contributors](https://img.shields.io/github/contributors/darkterminal/twigniter) ![GitHub commit activity](https://img.shields.io/github/commit-activity/m/darkterminal/twigniter)
-----

## What is Twigniter :fireworks:

Twigniter is a CodeIgniter Application Development Framework - a Boilerplate - for people
who build web sites using PHP and Twig as Template Engine. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. Twigniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

### Features

- Use All PHP Built-In Functions **Inside Twig Template**
- Twig Functions
- Twig Filters
- Autoload Defined User Constants (Helper) [See](https://github.com/darkterminal/twigniter/blob/master/application/core/Betta_Controller.php#L56)
- Autoload Defined Functions (Helper) [See](https://github.com/darkterminal/twigniter/blob/master/application/helpers/app_helper.php)
- Autoload Defined Filters (Helper) [See](https://github.com/darkterminal/twigniter/blob/master/application/helpers/app_filters.php)
- Symfony VarDumper: Using `debug($data, $die = false)`

### Changelog and New Features

You can find a list of all changes for each release in the [user
guide change log](https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst).

### Server Requirements

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

### Installation

**Composer**

```bash
$ composer create-project twigniter/codeigniter
```

**Manual**

```bash
$ git clone https://github.com/darkterminal/twigniter.git
```
or
```bash
$ git clone git@github.com:darkterminal/twigniter.git
```

### License

Please see the [license
agreement](https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst).

### Resources

-  [User Guide](https://codeigniter.com/docs)
-  [Language File Translations](https://github.com/bcit-ci/codeigniter3-translations)
-  [Community Forums](http://forum.codeigniter.com/)
-  [Community Wiki](https://github.com/bcit-ci/CodeIgniter/wiki)
-  [Community Slack Channel](https://codeigniterchat.slack.com)
-  [Twig Documentation](https://twig.symfony.com/doc/3.x/)

Report security issues to our [Security Panel](mailto:security@codeigniter.com)
or via our [page on HackerOne](https://hackerone.com/codeigniter), thank you.

### Acknowledgement

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
