package repository

import (
	"akutansi-web-api/model"
)

type UserRepository interface {
	FindAllUserPublic() ([]*model.UserPublic, error)
}
