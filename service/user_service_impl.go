package service

import (
	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"

	"akutansi-web-api/helper"
	"akutansi-web-api/repository"
)

/*
| -----------------------------------------------------------------
| PREPARATIONS
| -----------------------------------------------------------------
*/

type userService struct {
	userRepository repository.UserRepository
	validator      *validator.Validate
}

func NewUserService(userRepository repository.UserRepository, validator *validator.Validate) UserService {
	return &userService{
		userRepository: userRepository,
		validator:      validator,
	}
}

/*
| -----------------------------------------------------------------
| FUNCTIONS
| -----------------------------------------------------------------
*/

func (s *userService) FindAll(ctx *fiber.Ctx) error {
	users, err := s.userRepository.FindAllUserPublic()

	if err != nil {
		return helper.GetResponse(ctx, &helper.Response{
			Status:  fiber.StatusInternalServerError,
			Message: "Internal server error",
		})
	}

	return helper.GetResponse(ctx, &helper.Response{
		Status:  fiber.StatusOK,
		Message: "Success get all users",
		Data:    users,
	})
}
