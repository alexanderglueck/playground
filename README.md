# Playground

A playground where I play with different packages and Docker setups. 

## Ideas

- [x] Look into [archtechx/tenancy](https://github.com/archtechx/tenancy) 
  - Experiment with the subdomain approach (see Slack)
- [x] Check out [multi-stage builds](https://docs.docker.com/build/building/multi-stage/) 
- [ ] Optimize Dockerfile
  - [x] Investigate opcache
  - Improve readability and image size
- [ ] Research "correct" timezone handling
  - Store everything in UTC
  - Display in local timezone
  - Deal with local timezones (Send less important notifications only during 06:00 and 18:00 (local timezone))
- [ ] L10n and i18n
- [ ] Custom field handling
  - [x] Support custom fields
  - [ ] Support adding custom fields in the application
  - [ ] Support removing custom fields in the application
- [ ] Custom view handling
  - [x] Support custom views (e.g. Customer: name, address / Company: company name, address, vat id) 
  - [ ] Make it user manageable
- [ ] Extract Docker components to a Composer package
- [ ] Add invoice system
  - Adhere to [invoice criteria](https://www.wko.at/service/steuern/Erfordernisse-einer-Rechnung.html)
- [ ] Experiment with Events (simple/recurring/exceptions)
