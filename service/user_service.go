package service

import (
	"manajemen_tugas_master/model/domain"
)

type UserService interface {
	SignupUser(user *domain.User) (string, error)
	LoginUser(user *domain.User) (string, error)
}
