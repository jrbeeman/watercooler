# Overview

This module is a text filter that implements the Decoda library. The library provides fairly comprehensive text filtering, and it is recommended to avoid use of most Drupal core HTML filters, e.g. automatic link generation, when using this filter.

# Managing configuration

From the Decoda library vendor director, copy `src/config` to a location of your choice. It is recommended to put this configuration outside of your docroot.

When configuring the filter, you can reference your custom configuration path. The path should be absolute, or relative to the Drupal docroot. e.g. `../config/decoda`.