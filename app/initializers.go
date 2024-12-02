package app

import (
	"manajemen_tugas_master/controller"
	"manajemen_tugas_master/repository"
	"manajemen_tugas_master/service"

	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2/middleware/session"
	"gorm.io/gorm"
)

// user
func InitializeRepositoryUser(db *gorm.DB) (repository.UserRepository, error) {
	return repository.NewUserRepository(db), nil
}

func InitializeServiceUser(userRepository repository.UserRepository) (service.UserService, error) {
	return service.NewUserService(userRepository, validator.New()), nil
}

func InitializeControllerUser(userService service.UserService, store *session.Store) (controller.UserController, error) {
	return *controller.NewUserController(userService, store), nil
}