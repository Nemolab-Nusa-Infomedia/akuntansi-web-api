package app

import (
	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2/middleware/session"
	"gorm.io/gorm"

	"akutansi-web-api/controller"
	"akutansi-web-api/repository"
	"akutansi-web-api/service"
)

func UserInitialize(db *gorm.DB, store *session.Store) (controller.UserController, error) {
	userRepository := repository.NewUserRepository(db)
	userService := service.NewUserService(userRepository, validator.New())
	userController := controller.NewUserController(userService, store)

	return *userController, nil
}
