# Page Content Type - Complete Field Configuration

## Summary

The **page** content type in this Drupal installation contains:
- **1 custom field**: `field_page_sections`
- **20 base fields** (inherited from the node entity type)

---

## Custom Fields (Page-Specific)

| Field Machine Name | Field Type | Cardinality | Description |
|---|---|---|---|
| `field_page_sections` | entity_reference_revisions | Unlimited (-1) | References paragraph entities for page content organization |

**Status in Forms**: Currently **hidden** from the node edit form (form display configuration hides this field)

---

## Base Fields (Node Entity - Inherited)

### Required Fields
| Field Machine Name | Field Type | Cardinality | Label |
|---|---|---|---|
| `type` | entity_reference | 1 (Single) | Content Type |
| `title` | string | 1 (Single) | Title |

### System/Metadata Fields
| Field Machine Name | Field Type | Cardinality | Purpose |
|---|---|---|---|
| `nid` | integer | 1 | Node ID (unique identifier) |
| `uuid` | uuid | 1 | Universally Unique Identifier |
| `vid` | integer | 1 | Version ID (revision identifier) |
| `created` | created | 1 | Creation timestamp |
| `changed` | changed | 1 | Last modified timestamp |
| `uid` | entity_reference | 1 | Author (user reference) |
| `status` | boolean | 1 | Published status |
| `promote` | boolean | 1 | Promote to front page |
| `sticky` | boolean | 1 | Sticky at top of lists |
| `langcode` | language | 1 | Language code |
| `default_langcode` | boolean | 1 | Default language flag |

### Revision Fields
| Field Machine Name | Field Type | Cardinality | Purpose |
|---|---|---|---|
| `revision_timestamp` | created | 1 | Revision creation time |
| `revision_uid` | entity_reference | 1 | Revision author |
| `revision_log` | string_long | 1 | Revision log message |
| `revision_default` | boolean | 1 | Default revision flag |
| `revision_translation_affected` | boolean | 1 | Translation affected flag |

### Navigation Fields
| Field Machine Name | Field Type | Cardinality | Purpose |
|---|---|---|---|
| `path` | path | 1 | URL alias (path field) |
| `menu_link` | entity_reference | 1 | Menu link reference |

---

## Form Display Configuration

**Current State**: Form display for default form mode (node.page.default)

### Visible Fields in Form
- `title` (string_textfield widget) - weight: -5
- `uid` (entity_reference_autocomplete widget) - weight: 5
- `created` (datetime_timestamp widget) - weight: 10
- `path` (path widget) - weight: 30
- `status` (boolean_checkbox widget) - weight: 120

### Hidden Fields in Form
- `field_page_sections` - **HIDDEN** (currently causing form performance issues)
- `promote` - hidden
- `sticky` - hidden

**Config File**: `core.entity_form_display.node.page.default.yml`
**Location**: `web/sites/default/files/config_[hash]/sync/`

---

## Field Usage Summary

### Single Value Fields
- All base fields except `field_page_sections` are single-value (cardinality = 1)
- Total: 20 single-value base fields

### Unlimited/Multi-Value Fields
- `field_page_sections` - **Unlimited cardinality (-1)**
- This field can contain any number of paragraph references

---

## Notes

1. **field_page_sections Issue**: The custom field is currently **hidden from the edit form** to address memory/performance issues. There's a custom module (`hide_paragraphs_field`) that hides this field.

2. **Field Storage**: The field definitions for base fields and the `field_page_sections` field are stored in the Drupal database. Only the form display configuration is currently exported to version control.

3. **Field Type Details**:
   - `entity_reference_revisions`: References paragraph entities with revision support
   - `created`: Timestamp field type
   - `boolean`: True/False field type
   - `string`: Text field (limited length)
   - `string_long`: Text field (unlimited length)
   - `integer`: Whole number
   - `uuid`: UUID format string
   - `language`: Language selection field
   - `path`: URL path/alias field
   - `entity_reference`: Reference to other entities

---

## Generated Information

**Workspace**: `c:\xampp\htdocs\sharajman-drupal`
**Date**: February 26, 2026
**Method**: Drush field:info + field:base-info commands
**Drupal Version**: 10.x
