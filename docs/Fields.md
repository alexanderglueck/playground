# Fields

Information to keep in mind when adding new fields or field types.

## Adding new fields

To add a new field, add the configuration to the FieldsTableSeeder.
If you are using an existing field type, you're done. It's that simple. 

If you are using a new field type, continue with the next section.

## Adding new field types

Create a view for the field type you just created in the support/input_types/ directory. This view will be used when 
viewing a field with the new field type. 

After creating the view, create the corresponding PHP class in the Support/InputTypes directory. 

Once the input class is created, add an entry to the match inside the App/Support/Layout class.

Remember to also update the App/Services/ViewValidationService class, so it can properly validate the incoming data.

Depending on which `view_type` you chose, add a handler for the field to the request/controller/service. 
