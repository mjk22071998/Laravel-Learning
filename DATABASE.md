# Database In Laravel

## Database constraints for data integrity

`CASCADE`: Ensures that when a parent record is deleted or updated, the corresponding child records are automatically deleted or updated; use it when dependent data should follow changes to the parent.
`RESTRICT`: Prevents deletion or update of a parent record if associated child records exist; use it to ensure no orphaned records are created.
`SET NULL`: Sets the foreign key in child records to NULL when the parent record is deleted or updated; use it when the relationship is optional, and child records should remain disassociated.
`NO ACTION`: Prevents changes to a parent record if it would break referential integrity but allows temporary inconsistencies during a transaction; use it for deferred integrity checks.
`SET DEFAULT`: Sets the foreign key in child records to a predefined default value when the parent record is deleted or updated; use it when child records need a fallback value.
