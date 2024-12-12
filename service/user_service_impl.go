package service

import (
	"github.com/go-playground/validator/v10"

	"akutansi-web-api/model/domain"
	"akutansi-web-api/repository"
)

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

func (s *userService) FindAllUsers() ([]*domain.UserPublic, error) {
	return s.userRepository.FindAll()
}
