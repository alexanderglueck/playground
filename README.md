# Playground

A playground where I play with different packages and Docker setups. 

## Ideas

- [x] Look into [archtechx/tenancy](https://github.com/archtechx/tenancy) 
  - Experiment with the subdomain approach (see Slack)
- [x] Check out [multi-stage builds](https://docs.docker.com/build/building/multi-stage/) 
- [ ] Optimize Dockerfile
  - [x] Investigate opcache
  - Improve readability and image size
  - Provide production image (files bundled, container for web, container for queues, container for scheduler)
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
  - [x] Render custom views
- [ ] Extract Docker components to a Composer package
- [ ] Add invoice system
  - Adhere to [invoice criteria](https://www.wko.at/service/steuern/Erfordernisse-einer-Rechnung.html)
- [ ] Experiment with Events (simple/recurring/exceptions)
  - Add column for recurrence end date (to filter out recurring events from the past)
- [x] Sharing center
  - [x] A list where all shared resources are listed
  - [x] List includes the date it was shared, and a way to remove the share
- [ ] Command pallet
  - Search objects (contacts, contact groups, invoices)
  - Search for menu entries (New Invoice, Settings)
- [ ] Features
  - [ ] Queued contact export
  - [ ] Queued contact import with preview form 
  - [ ] Contact search
  - [ ] Multi contact modification (from search)
  - [ ] Modification history
  - [ ] Geocoding on contacts
  - [ ] Tasks
    - [ ] Task deadline in calendar
  - [ ] Comments
    - [x] Contacts
  - [ ] See who is currently viewing a page (Websockets (soketi))
  - [ ] User groups
    - [ ] Permissions on user groups
      - Groups on resource-parents (invoice groups are parents of invoices, contact groups are parents of contacts)
  - [x] Notes 
  -   [x] Initial implementation
  -   [x] Markdown support (CKEditor)
  - [ ] Calendar sync-able to Google Calendar (ics export)
  - [ ] Multiple calendar support (User can have multiple calendars)
  - [ ] Calendars can be shared with other users
  - [ ] Calendars can be shared publicly (should be visible in sharing center)
  - [ ] Show contact birthday in calendar
  - [x] Change calendar starts at and ends at to datetime
  - [ ] User profile images
- [ ] Widgets
- [ ] Configurable webhook endpoints to send updates to other recipients (not set in stone)
- [ ] PDF preview using pdf.js
- [x] Invoice PDFs using [weasyprint](https://weasyprint.org/) (rudimentary support)
- [ ] HTML to markdown conversion (for sanitization reasons)
- [x] Html sanitization (comments, notes) (symfony/html-sanitizer)
- [ ] Notifications for actions (Queued export ready, User accepted an invitation)
- [ ] Use meilisearch for facet search

## Setup

Edit the .env file and enter your credentials
php artisan migrate
php artisan db:seed
