package service

import (
	"akutansi-web-api/model/domain"
)

type UserService interface {
	FindAllUsers() ([]*domain.UserPublic, error)
}
