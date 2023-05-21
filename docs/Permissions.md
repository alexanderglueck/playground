# Permissions

The permission system is divided into two major parts. The application and the database layer. 

## Overview

The job of the application layer is to make sure the user is allowed to access the current model. 
The job of the database layer is to make sure the user only gets access to models he is allowed to view. 
Ideally the database layer would already prevent the application from fetching models the user is now allowed to access. 

## Application
The playground uses the following permission model:

Permissions are always checked in controllers and views using the `authorize` and `can` methods respectively.
The permissions are checked using policies, e.g. `$this->authorize('view', $contact)`or `can('view', $contact)`.
This allows the system to perform multiple permission checks in the policy. 

The policy then checks the user assigned permissions using hyphenated permission names, e.g. `view-contact` or `edit-contact`. 

## Database

The database and more specifically Global Scopes are used to filter all models down to user accessible models.

E.g. only listing contacts from contact groups the user has access to. 
