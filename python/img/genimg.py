# -*- coding: UTF-8 -*-

import os
import pygame
from pygame.locals import *

pygame.init()
text = u'kendreamcar'
font = pygame.font.SysFont('Microsoft YaHei', 65)
ftext = font.render(text, True, (66, 83, 130), (255, 255, 255))
pygame.image.save(ftext,'ken.jpg')
