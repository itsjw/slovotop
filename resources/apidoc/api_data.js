define({ "api": [
  {
    "version": "0.1.0",
    "group": "Access",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Change Access Menu",
    "name": "Change_Access_Menu",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,0-1",
            "optional": false,
            "field": "access",
            "description": "<p>access</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,>=1",
            "optional": false,
            "field": "menu",
            "description": "<p>menu ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,>=1",
            "optional": false,
            "field": "role",
            "description": "<p>role ID</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { ChangeAccessMenuMutation (access:1,menu:1,role:2) { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/Access/ChangeAccessMenuMutation.php",
    "groupTitle": "Access"
  },
  {
    "version": "0.1.0",
    "group": "Access",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Change Access Stage",
    "name": "Change_Access_Stage",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,0-1",
            "optional": false,
            "field": "access",
            "description": "<p>access</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,>=1",
            "optional": false,
            "field": "stage",
            "description": "<p>stage ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,>=1",
            "optional": false,
            "field": "role",
            "description": "<p>role ID</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { ChangeAccessStageMutation (access:1,stage:1,role:2) { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/Access/ChangeAccessStageMutation.php",
    "groupTitle": "Access"
  },
  {
    "version": "0.1.0",
    "group": "Access",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Change Access Task Field",
    "name": "Change_Access_Task_Field",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,0-1",
            "optional": false,
            "field": "access",
            "description": "<p>access</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,>=1",
            "optional": false,
            "field": "stage",
            "description": "<p>stage ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "field",
            "description": "<p>field name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { ChangeAccessTaskFieldMutation (access:1,stage:1,field:\"name\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/Access/ChangeAccessTaskFieldMutation.php",
    "groupTitle": "Access"
  },
  {
    "version": "0.1.0",
    "group": "Doc",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Doc-Add/Update",
    "name": "Doc_Add_Update",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required,1,2,3...",
            "optional": false,
            "field": "roles",
            "description": "<p>roles</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required",
            "optional": false,
            "field": "user",
            "description": "<p>user_id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "body",
            "description": "<p>body</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { AddDocMutation (id: 0,name:\"name\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/Doc/AddDocMutation.php",
    "groupTitle": "Doc"
  },
  {
    "version": "0.1.0",
    "group": "Doc",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Doc-Delete",
    "name": "Doc_Delete",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "1,2,3..",
            "optional": false,
            "field": "items",
            "description": "<p>items</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { DeleteDocMutation (items:\"1,2,3\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/Doc/DeleteDocMutation.php",
    "groupTitle": "Doc"
  },
  {
    "version": "0.1.0",
    "group": "Doc",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Doc-Query",
    "name": "Doc_Query",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "searchName",
            "description": "<p>searchName</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"{ DocQuery ( id:1,searchName:\"searchName\" ) { id,name...}\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "body",
            "description": "<p>body</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "user",
            "description": "<p>[User]</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "roles",
            "description": "<p>[Roles]</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>created_at</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>updated_at</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "{\"query\":\"{ DocQuery { id,name,body,user{id,name},roles{access},created_at,updated_at } }\"}",
        "type": "json"
      }
    ],
    "filename": "/home/www/slovo.zz/app/GraphQL/Query/Doc/DocQuery.php",
    "groupTitle": "Doc"
  },
  {
    "version": "0.1.0",
    "group": "Menu",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Menu-Query",
    "name": "Menu_Query",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "role_id",
            "description": "<p>role_id</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"{ MenuQuery ( id:1,role_id:1 ) { id,name...}\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "slug",
            "description": "<p>slug</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "refer",
            "description": "<p>refer</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>created_at</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>updated_at</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "{\"query\":\"{ MenuQuery { id,name,slug,refer,roles{access},created_at,updated_at } }\"}",
        "type": "json"
      }
    ],
    "filename": "/home/www/slovo.zz/app/GraphQL/Query/Menu/MenuQuery.php",
    "groupTitle": "Menu"
  },
  {
    "version": "0.1.0",
    "group": "Project",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Project-Add/Update",
    "name": "Project_Add_Update",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,>=0",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "site",
            "description": "<p>site</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,>=1",
            "optional": false,
            "field": "user_id",
            "description": "<p>user_id</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { AddProjectMutation (id: 0,name:\"name\",site:\"site\",user_id:1) { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/Project/AddProjectMutation.php",
    "groupTitle": "Project"
  },
  {
    "version": "0.1.0",
    "group": "Project",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Project-Delete",
    "name": "Project_Delete",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "1,2,3..",
            "optional": false,
            "field": "items",
            "description": "<p>items</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { DeleteProjectMutation (items:\"1,2,3\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/Project/DeletProjectMutation.php",
    "groupTitle": "Project"
  },
  {
    "version": "0.1.0",
    "group": "Project",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Project-Query",
    "name": "Project_Query",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "site",
            "description": "<p>site</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "owner",
            "description": "<p>owner</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"{ ProjectQuery ( id:1,owner:\"owner\" ) { id,name...}\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "site",
            "description": "<p>site</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "user",
            "description": "<p>[User]</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>created_at</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>updated_at</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "{\"query\":\"{ ProjectQuery { id,name,site,user{ia,name},created_at,updated_at } }\"}",
        "type": "json"
      }
    ],
    "filename": "/home/www/slovo.zz/app/GraphQL/Query/Project/ProjectQuery.php",
    "groupTitle": "Project"
  },
  {
    "version": "0.1.0",
    "group": "Role",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Role-Add/Update",
    "name": "Role_Add_Update",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { AddRoleMutation (id: 0,name:\"name\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/Role/AddRoleMutation.php",
    "groupTitle": "Role"
  },
  {
    "version": "0.1.0",
    "group": "Role",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Role-Delete",
    "name": "Role_Delete",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "1,2,3..",
            "optional": false,
            "field": "items",
            "description": "<p>items</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { DeleteRoleMutation (items:\"1,2,3\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/Role/DeleteRoleMutation.php",
    "groupTitle": "Role"
  },
  {
    "version": "0.1.0",
    "group": "Role",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "Role-Query",
    "name": "Role_Query",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"{ RoleQuery ( id:1 ) { id,name...}\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "count",
            "description": "<p>count</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>created_at</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>updated_at</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "{\"query\":\"{ RoleQuery { id,name,count,created_at,updated_at } }\"}",
        "type": "json"
      }
    ],
    "filename": "/home/www/slovo.zz/app/GraphQL/Query/Role/RoleQuery.php",
    "groupTitle": "Role"
  },
  {
    "version": "0.1.0",
    "group": "Stage_Task_Access",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/api/stageAccess",
    "title": "StageTaskAccess-Query",
    "name": "StageTaskAccess_Query",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required",
            "optional": false,
            "field": "stage",
            "description": "<p>stage</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"stage\":\"2\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "fields",
            "description": "<p>['access','name']</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "{\"stage\":\"2\"}",
        "type": "json"
      }
    ],
    "filename": "/home/www/slovo.zz/app/Http/Controllers/Crm/StageTaskController.php",
    "groupTitle": "Stage_Task_Access"
  },
  {
    "version": "0.1.0",
    "group": "Task_Stage",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "AddTaskStage-Add/Update",
    "name": "AddTaskStage_Add_Update",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,unique",
            "optional": false,
            "field": "priority",
            "description": "<p>priority</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "integer",
            "optional": false,
            "field": "price",
            "description": "<p>price</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { AddTaskStageMutation (id: 0,name:\"name\",priority:1) { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/TaskStage/AddTaskStageMutation.php",
    "groupTitle": "Task_Stage"
  },
  {
    "version": "0.1.0",
    "group": "Task_Stage",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "TaskStage-Delete",
    "name": "TaskStage_Delete",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "1,2,3..",
            "optional": false,
            "field": "items",
            "description": "<p>items</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { DeleteTaskStageMutation (items:\"1,2,3\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/TaskStage/DeleteTaskStageMutation.php",
    "groupTitle": "Task_Stage"
  },
  {
    "version": "0.1.0",
    "group": "Task_Stage",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "TaskStage-Query",
    "name": "TaskStage_Query",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "role_id",
            "description": "<p>role_id</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"{ TaskStageQuery ( id:1,role_id:1 ) { id,name...}\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "priority",
            "description": "<p>priority</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "price",
            "description": "<p>price</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>created_at</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>updated_at</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "{\"query\":\"{ TaskStageQuery { id,name,priority,created_at,updated_at,roles{access} } }\"}",
        "type": "json"
      }
    ],
    "filename": "/home/www/slovo.zz/app/GraphQL/Query/TaskStage/TaskStageQuery.php",
    "groupTitle": "Task_Stage"
  },
  {
    "version": "0.1.0",
    "group": "Task_Subject",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "TaskSubject-Add/Update",
    "name": "TaskSubject_Add_Update",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required",
            "optional": false,
            "field": "price",
            "description": "<p>price</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { AddTaskSubjectMutation (id: 0,name:\"name\",price:100) { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/TaskSubject/AddTaskSubjectMutation.php",
    "groupTitle": "Task_Subject"
  },
  {
    "version": "0.1.0",
    "group": "Task_Subject",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "TaskSubject-Delete",
    "name": "TaskSubject_Delete",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "1,2,3..",
            "optional": false,
            "field": "items",
            "description": "<p>items</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { DeleteTaskSubjectMutation (items:\"1,2,3\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/TaskSubject/DeleteTaskSubjectMutation.php",
    "groupTitle": "Task_Subject"
  },
  {
    "version": "0.1.0",
    "group": "Task_Subject",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "TaskSubject-Query",
    "name": "TaskSubject_Query",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "searchName",
            "description": "<p>searchName</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "orderPrice",
            "description": "<p>order by price</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"{ TaskSubjectQuery ( id:1,searchName:\"searchName\",orderPrice:\"asc\" ) { id,name...}\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "price",
            "description": "<p>price</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>created_at</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>updated_at</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "{\"query\":\"{ TaskSubjectQuery { id,name,price,created_at,updated_at } }\"}",
        "type": "json"
      }
    ],
    "filename": "/home/www/slovo.zz/app/GraphQL/Query/TaskSubject/TaskSubjectQuery.php",
    "groupTitle": "Task_Subject"
  },
  {
    "version": "0.1.0",
    "group": "User",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "User-Add",
    "name": "User_Add",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,>=0",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>surname</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required,email,unique",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "role",
            "description": "<p>role (1,2,3)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required,min:6",
            "optional": false,
            "field": "password",
            "description": "<p>password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "confirm",
            "description": "<p>confirm</p>"
          },
          {
            "group": "Parameter",
            "type": "Float",
            "optional": false,
            "field": "up_price",
            "description": "<p>up_price</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "note",
            "description": "<p>note</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { AddUserMutation (id: 0,name:\"name\",email:\"email\",role: \"1,2\",confirm:\n1,password: \"password\" ) { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/User/AddUserMutation.php",
    "groupTitle": "User"
  },
  {
    "version": "0.1.0",
    "group": "User",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "User-Approve",
    "name": "User_Approve",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "1,2,3...",
            "optional": false,
            "field": "items",
            "description": "<p>items</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { ApproveUserMutation (items: \"1,2,3\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/User/ApproveUserMutation.php",
    "groupTitle": "User"
  },
  {
    "version": "0.1.0",
    "group": "User",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "User-Delete",
    "name": "User_Delete",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "1,2,3...",
            "optional": false,
            "field": "items",
            "description": "<p>items</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { DeleteUserMutation (items: \"1,2,3\") { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/User/DeleteUserMutation.php",
    "groupTitle": "User"
  },
  {
    "version": "0.1.0",
    "group": "User",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "User-Update",
    "name": "User_Update",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "size": "required,1..",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "surname",
            "description": "<p>surname</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required,email,unique",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "required",
            "optional": false,
            "field": "role",
            "description": "<p>role (1,2,3)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "confirm",
            "description": "<p>confirm</p>"
          },
          {
            "group": "Parameter",
            "type": "Float",
            "optional": false,
            "field": "up_price",
            "description": "<p>up_price</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "note",
            "description": "<p>note</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"mutation { UpdateUserMutation (id: 1,name:\"name\",email:\"email\",role: \"1,2\",confirm:\n1,password: \"password\" ) { id } }\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "id",
            "description": "<p>['id' =&gt; id ,'notify' =&gt; trans('data.notifyOK')]</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/GraphQL/Mutation/User/UpdateUserMutation.php",
    "groupTitle": "User"
  },
  {
    "version": "0.1.0",
    "group": "User",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "/apps/v2",
    "title": "User-query",
    "name": "User_query",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>id</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "orderID",
            "description": "<p>order by ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\"query\":\"{ UserQuery ( id:1,orderID:\"asc\" ) { id,name,surname,...}\"}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Success 200",
            "type": "Float",
            "optional": false,
            "field": "up_price",
            "description": "<p>up_price</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "note",
            "description": "<p>note</p>"
          },
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "confirm",
            "description": "<p>confirm</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "roles",
            "description": "<p>[Roles]</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "tasksCount",
            "description": "<p>tasksCount</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "lastLogin",
            "description": "<p>[LastLogin]</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>created_at</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>updated_at</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "{\"query\":\"{ UserQuery { id,name,email,role{id,name},tasksCount,lastLogin{updated_at},up_price,note,confirm,\ncreated_at,updated_at } }\"}",
        "type": "json"
      }
    ],
    "filename": "/home/www/slovo.zz/app/GraphQL/Query/User/UserQuery.php",
    "groupTitle": "User"
  }
] });
