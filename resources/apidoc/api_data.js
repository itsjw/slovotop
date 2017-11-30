define({ "api": [
  {
    "version": "0.2.0",
    "group": "User",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "approveUser",
    "title": "approveUser(s)",
    "name": "approveUser",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "items",
            "description": "<p>users's ID [1,2,3...]</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{items:{1,2,3}}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>trans('data.notifyOK')</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "version": "0.2.0",
    "group": "User",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "deleteUser",
    "title": "deleteUser(s)",
    "name": "deleteUser",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "items",
            "description": "<p>users's ID [1,2,3...]</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{items:{1,2,3}}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>trans('data.notifyOK')</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "version": "0.2.0",
    "group": "User",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "getUsers",
    "title": "getUser(s)",
    "name": "getUser",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>ID if need getUser</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Search name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Search email</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{id: 1,name:'xxx',email:'xxx'}",
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
            "type": "Integer",
            "optional": false,
            "field": "confirm",
            "description": "<p>confirm</p>"
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
            "type": "Datetime",
            "optional": false,
            "field": "lastLogin",
            "description": "<p>lastLogin format('d-m-Y H:m:s')</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "roles",
            "description": "<p>roles{id,name}</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "created_at",
            "description": "<p>created_at format('d-m-Y H:m:s')</p>"
          },
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "up_price",
            "description": "<p>price</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "note",
            "description": "<p>note</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  },
  {
    "version": "0.2.0",
    "group": "User",
    "permission": [
      {
        "name": "auth"
      }
    ],
    "type": "post",
    "url": "saveUser",
    "title": "saveUser",
    "name": "saveUser",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "Required",
            "optional": false,
            "field": "name",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "Required,Unique",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
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
          },
          {
            "group": "Parameter",
            "type": "Array",
            "size": "Required",
            "optional": false,
            "field": "role",
            "description": "<p>role's ID [1,2,3..]</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>password</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{name:'xxx',email:'xxx',up_price:1,note:'xxx',role:{1,2,3},password:'xxx'}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "success",
            "description": "<p>trans('data.notifyOK')</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Array",
            "optional": false,
            "field": "errors",
            "description": "<p>errors{name:'error xxx',...}</p>"
          }
        ]
      }
    },
    "filename": "/home/www/slovo.zz/app/Http/Controllers/Api/UserController.php",
    "groupTitle": "User"
  }
] });
