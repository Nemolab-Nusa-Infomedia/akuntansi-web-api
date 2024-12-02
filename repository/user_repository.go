package repository

import (
	"manajemen_tugas_master/model/domain"
)

// UserRepository adalah interface untuk operasi-operasi yang berhubungan dengan entitas User
type UserRepository interface {
	Signup(user *domain.User) error
	Login(user *domain.User) (*domain.User, error)
}
