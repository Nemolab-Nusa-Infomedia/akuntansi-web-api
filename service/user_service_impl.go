package service

import (
	"manajemen_tugas_master/model/domain"
	"manajemen_tugas_master/repository"
	"sync"
	"time"

	"github.com/go-playground/validator/v10"
)

type userService struct {
	userRepository repository.UserRepository
	validator      *validator.Validate
	resetCodes     map[string]resetCodeInfo
	resetMutex     sync.Mutex
}

type resetCodeInfo struct {
	code      string
	expiresAt time.Time
}

func NewUserService(userRepository repository.UserRepository, validator *validator.Validate) UserService {
	return &userService{
		userRepository: userRepository,
		validator:      validator,
		resetCodes:     make(map[string]resetCodeInfo),
	}
}

func (s *userService) SignupUser(user *domain.User) (string, error) {
	return "", nil
}

func (s *userService) LoginUser(user *domain.User) (string, error) {

	return "", nil
}
