<?php
namespace App;
enum UserType: string {
    case User = "user";
    case Admin = "admin";
    case SuperAdmin = "superAdmin";
}